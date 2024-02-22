<?php

if (!function_exists('translated_date')) {
    function translated_date($format, $dateTime = 'now', $locale = 'en')
    {
        $translatedDate = date($format, strtotime($dateTime));

        $translations = array(
            'en' => array(
                'January'  => 'January',
                'February' => 'February',
                'March'    => 'March',
                'April'    => 'April',
                'May'      => 'May',
                'June'     => 'June',
                'July'     => 'July',
                'August'   => 'August',
                'September'=> 'September',
                'October'  => 'October',
                'November' => 'November',
                'December' => 'December',
            ),
            'ru' => array(
                'January'  => 'Январь',
                'February' => 'Февраль',
                'March'    => 'Март',
                'April'    => 'Апрель',
                'May'      => 'Май',
                'June'     => 'Июнь',
                'July'     => 'Июль',
                'August'   => 'Август',
                'September'=> 'Сентябрь',
                'October'  => 'Октябрь',
                'November' => 'Ноябрь',
                'December' => 'Декабрь',
            ),
            'az' => array(
                'January'  => 'Yanvar',
                'February' => 'Fevral',
                'March'    => 'Mart',
                'April'    => 'Aprel',
                'May'      => 'May',
                'June'     => 'İyun',
                'July'     => 'İyul',
                'August'   => 'Avqust',
                'September'=> 'Sentyabr',
                'October'  => 'Oktyabr',
                'November' => 'Noyabr',
                'December' => 'Dekabr',
            ),
        );

        if (isset($translations[$locale])) {
            $translation = $translations[$locale];
            foreach ($translation as $en => $translated) {
                $translatedDate = str_replace($en, $translated, $translatedDate);
            }
        }

        if ($locale == 'az' && strpos($translatedDate, 'İyun') !== false && strpos($format, 'F') === false) {
            $translatedDate = str_replace('İyun', 'June', $translatedDate);
        }

        return $translatedDate;
    }
}


//{{static_get('about')}}

if (!function_exists('static_get')) {
    function static_get($id)
    {
        return \App\Models\StaticModel::with('translations')->where('id',$id)->first()->title ?? null;
    }
}


if (!function_exists('_langUrl')) {
    function _langUrl($lang){
        $segments = request()->segments();
        $segments[0] = $lang;
        //config('app.url')
        return config('http://127.0.0.1:8000').'/'.implode('/',$segments);
    }
}
