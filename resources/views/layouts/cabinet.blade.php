
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/components/reset.css">
	<link rel="stylesheet" href="css/components/fonts.css">
	<link rel="stylesheet" href="css/dashboard.min.css">
	<link rel="stylesheet" href="css/updates.min.css">
	<link rel="stylesheet" href="css/main.min.css">
	<title>@yield('title')</title>
</head>
<body>
<aside class="sidebar">
    <a href="{{route('index')}}" class="logo">
        <picture><source srcset="img/logo.webp" type="image/webp"><img src="img/logo.png" alt="logo"></picture>
    </a>
    <div class="sidebar__profile">
        @if(strlen(auth()->user()->avatarPath) > 0)
            <img src="{{auth()->user()->avatarPath}}" width="50px" height="50px" alt="user"
                 class="sidebar__profile-image"/>
        @endif
        <div class="sidebar__profile-data">
            <span class="sidebar__profile-name">{{auth()->user()->name}} {{auth()->user()->lastname}}</span>
            <span class="sidebar__profile-username">{{auth()->user()->login}}</span>
        </div>
    </div>
    <div class="sidebar__controls">
        <a href="{{route('settings')}}" class="sidebar__controls-link">
            <svg class="settings sidebar__controls-icon">
                <use xlink:href="img/icons/icons.svg#settings"></use>
            </svg>
        </a>
        <a href="{{route('support')}}" class="sidebar__controls-link">
            <svg class="support sidebar__controls-icon">
                <use xlink:href="img/icons/icons.svg#support"></use>
            </svg>
        </a>
        <a href="#" class="sidebar__controls-link">
            <svg class="logout sidebar__controls-icon">
                <use xlink:href="img/icons/icons.svg#logout"></use>
            </svg>
        </a>
    </div>
    <div class="sidebar__balance-block">
        <span>Мой баланс</span>
        <div class="sidebar__balance-item">
            {{auth()->user()->wallet()->usdBalance}} USD
        </div>
        <div class="sidebar__balance-item">
            {{auth()->user()->wallet()->gfBalance}} <span>GF</span>
        </div>
    </div>
    <nav class="nav">
        <ul class="nav__list">
            <li class="nav__list-item">
                <a href="{{route('main')}}">
                    <picture><source srcset="img/dashboard/main-icon.webp" type="image/webp"><img src="img/dashboard/main-icon.png" alt="main" class="nav__list-item_icon"></picture>
                    <picture><source srcset="img/dashboard/main-icon-wh.webp" type="image/webp"><img src="img/dashboard/main-icon-wh.png" alt="main" class="nav__list-item_icon white-icon"></picture>
                    <span>Главная</span>
                    <svg class="mark-right">
                        <use xlink:href="img/icons/icons.svg#mark-down"></use>
                    </svg>
                </a>
            </li>
            <li class="nav__list-item">
                <a href="{{route('exchange')}}">
                    <picture><source srcset="img/dashboard/graph-icon.webp" type="image/webp"><img src="img/dashboard/graph-icon.png" alt="graph" class="nav__list-item_icon"></picture>
                    <picture><source srcset="img/dashboard/graph-icon-wh.webp" type="image/webp"><img src="img/dashboard/graph-icon-wh.png" alt="graph" class="nav__list-item_icon white-icon"></picture>
                    <span>Токен биржа</span>
                    <svg class="mark-right">
                        <use xlink:href="img/icons/icons.svg#mark-down"></use>
                    </svg>
                </a>
            </li>
            <li class="nav__list-item">
                <a href="{{route('finance')}}">
                    <picture><source srcset="img/dashboard/wallet-icon.webp" type="image/webp"><img src="img/dashboard/wallet-icon.png" alt="wallet" class="nav__list-item_icon"></picture>
                    <picture><source srcset="img/dashboard/wallet-icon-wh.webp" type="image/webp"><img src="img/dashboard/wallet-icon-wh.png" alt="wallet" class="nav__list-item_icon white-icon"></picture>
                    <span>Финансы</span>
                    <svg class="mark-right">
                        <use xlink:href="img/icons/icons.svg#mark-down"></use>
                    </svg>
                </a>
            </li>
            <li class="nav__list-item">
                <a href="{{route('team')}}">
                    <picture><source srcset="img/dashboard/team-icon.webp" type="image/webp"><img src="img/dashboard/team-icon.png" alt="team" class="nav__list-item_icon"></picture>
                    <picture><source srcset="img/dashboard/team-icon-wh.webp" type="image/webp"><img src="img/dashboard/team-icon-wh.png" alt="team" class="nav__list-item_icon white-icon"></picture>
                    <span>Команда</span>
                    <svg class="mark-right">
                        <use xlink:href="img/icons/icons.svg#mark-down"></use>
                    </svg>
                </a>
            </li>
            <li class="nav__list-item">
                <a href="{{route('platforms')}}">
                    <picture><source srcset="img/dashboard/cards-icon.webp" type="image/webp"><img src="img/dashboard/cards-icon.png" alt="cards" class="nav__list-item_icon"></picture>
                    <picture><source srcset="img/dashboard/cards-icon-wh.webp" type="image/webp"><img src="img/dashboard/cards-icon-wh.png" alt="cards" class="nav__list-item_icon white-icon"></picture>
                    <span>Площадки</span>
                    <svg class="mark-right">
                        <use xlink:href="img/icons/icons.svg#mark-down"></use>
                    </svg>
                </a>
            </li><li class="nav__list-item">
                <a href="{{route('updates')}}">
                    <picture><source srcset="img/dashboard/update-icon.webp" type="image/webp"><img src="img/dashboard/update-icon.png" alt="update" class="nav__list-item_icon"></picture>
                    <picture><source srcset="img/dashboard/update-icon-wh.webp" type="image/webp"><img src="img/dashboard/update-icon-wh.png" alt="update" class="nav__list-item_icon white-icon"></picture>
                    <span>Обновления</span>
                    <svg class="mark-right">
                        <use xlink:href="img/icons/icons.svg#mark-down"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
</aside>
@yield('content')
</body>
</html>
