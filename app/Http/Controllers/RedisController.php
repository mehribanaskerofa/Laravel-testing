<?php

namespace App\Http\Controllers;

use App\Console\Commands\RegisterEmailCommand;
use App\Jobs\EmailSendJob;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class RedisController extends Controller
{

    private $redis;

    public function __construct()
    {
       $this->redis= _redisConnect();
    }

    public function product_view($id){
        $product=Product::where('id',$id)->first();

        if ($product){
            $view=$this->redis->incr('product:'.$id.'view');
//            return 'Product:'.$id.' viewed '.$view.' time';
        }

        $tags=$this->redis->smembers('product:'.$product->id.':tags');

        return $tags;
    }
    private function product_all(){
        $result=Cache::remember('product_all',100,function (){
            return Product::all();
        });
        return $result;
    }
    private function product_alls(){
        $result=Cache::remember('product_alll',100,function (){
            return Product::all();
        });
        return $result;
    }


    public function products_data(){
        DB::connection()->enableQueryLog();

        $datas=$this->product_all();

        $query_Log=DB::getQueryLog();

        return $datas;
    }
    public function products_datas(){
        DB::connection()->enableQueryLog();

        $datas=$this->product_alls();

        $query_Log=DB::getQueryLog();

        return $datas;
    }
    public function product_create(){

        $tags=['tag1','tag2','tag3'];
        $result=Product::create([
            'name'=>'prod3',
            'price'=>345,
            'tag'=>implode(',', $tags)
        ]);


        if ($result){
            if($result->tag){
                foreach ($tags as $tag){
                    $this->redis->zAdd('product:tag:'.$tag,$result->id,$result->id);
                    $this->redis->sAdd('product:'.$result->id.':tags',$tag);
                    $this->redis->sAdd('product:tags',$tag);

                }
            }
        }

        return $result;
    }
    public function products_tag($tag){
        $product_ids=$this->redis->zRange('product:tag'.$tag,0,-1);

        $products=Product::whereIn('id',$product_ids)->get();

        $tags=$this->redis->sRandMember('product:tags',4);

        return [$products,$tags];
    }

    public function posts_user_show($id){
        $this->redis->lTrim('posts:'.$id,0,100);

        $postsIDs=$this->redis->lRange('posts:'.$id,0,100);

        $posts=[];
        foreach ($postsIDs as $postID)
            $posts[$postID]=$this->redis->hGetAll('post:'.$postID);

        return $posts;
    }
    public function post_show($id){

    }
    public function post_update($id=4){
        $post_data='salam';

        $postId=$this->redis->incr('next_post_id');

        $postSuccess=$this->redis->hMSet('post:'.$postId,[
            'user_id'=>$id,
            'post'=>$post_data
        ]);
        if ($postSuccess){
            $followers=$this->redis->zRange('followers:'.$id,0,-1);

            $followers[]=$id;

            foreach ($followers as $followerID){
                $pushSuccess=$this->redis->lPush('post:'.$followerID,$postId);
            }
            if ($pushSuccess){
                return $postId;
            }
            $this->redis->del('post:'.$postId);
            $this->redis->decr('next_post_id');
        }

//        Post::create([
//            'feed_id'=>$id,
//            'post'=>$post_data
//        ]);
        return false;
    }
    public function feed_show(){

    }

    public function redister_admin(){
        $email='mkmk@mk.mk';

//        $this->dispatch(
//            new RegisterEmailCommand($email)
//        );
//        EmailSendJob::dispatch()->onQueue('your_queue_name');

        return 'oldu';
    }
    public function json_redis(){
//        $this->redis->set('json_data','{
//    "type": "object",
//    "properties": {
//        "name": {"type": "string"},
//        "age": {"type": "number"},
//        "city": {"type": "string"}
//    },
//    "required": ["name", "age", "city"]
//}');

        $data=json_decode($this->redis->get('json_data'),true);
        return $data;
    }
}
