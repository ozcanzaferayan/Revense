<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! Config::get('global.siteName') !!}</title>
    <link rel="stylesheet" href="{!! URL::asset('style/adm.css') !!}" />
</head>
<body>
    <aside id="adminLeftMenu">
        <ul>
            <li>
                <a href="javascript:void(0);">Kategoriler</a>
                <ul>
                    <li>
                        {{ Html::linkAction('AdminController@get_categories', 'Tüm Kategoriler') }}
                    </li>
                    <li>
                        {{ Html::linkAction('AdminController@get_addCategory', 'Yeni Kategori Ekle') }}
                    </li>
                </ul>
            </li>
            <li>
                {{ Html::linkAction('AdminController@get_logout', 'Çıkış Yap') }}
            </li>
        </ul>
    </aside>
    <div id="adminRightContent">
        @yield('content')
    </div>
</body>
</html>
