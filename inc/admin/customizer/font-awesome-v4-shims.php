<?php

/*
	Font Awesome 4 To 5 (For Future Reference)
	======================================= */

if ( ! function_exists( 'evolve_font_awesome_4_to_5' ) ) {
	function evolve_font_awesome_4_to_5( $old ) {
		$list_icons = array(
			"glass"                => array( "glass-martini" ),
			"meetup"               => array( "fab" ),
			"star-o"               => array( "far", "star" ),
			"remove"               => array( "times" ),
			"close"                => array( "times" ),
			"gear"                 => array( "cog" ),
			"trash-o"              => array( "far", "trash-alt" ),
			"file-o"               => array( "far", "file" ),
			"clock-o"              => array( "far", "clock" ),
			"arrow-circle-o-down"  => array( "far", "arrow-alt-circle-down" ),
			"arrow-circle-o-up"    => array( "far", "arrow-alt-circle-up" ),
			"play-circle-o"        => array( "far", "play-circle" ),
			"repeat"               => array( "redo" ),
			"rotate-right"         => array( "redo" ),
			"refresh"              => array( "sync" ),
			"list-alt"             => array( "far" ),
			"dedent"               => array( "outdent" ),
			"video-camera"         => array( "video" ),
			"picture-o"            => array( "far", "image" ),
			"photo"                => array( "far", "image" ),
			"image"                => array( "far", "image" ),
			"pencil"               => array( "pencil-alt" ),
			"map-marker"           => array( "map-marker-alt" ),
			"pencil-square-o"      => array( "far", "edit" ),
			"share-square-o"       => array( "far", "share-square" ),
			"check-square-o"       => array( "far", "check-square" ),
			"arrows"               => array( "arrows-alt" ),
			"times-circle-o"       => array( "far", "times-circle" ),
			"check-circle-o"       => array( "far", "check-circle" ),
			"mail-forward"         => array( "share" ),
			"eye"                  => array( "far" ),
			"eye-slash"            => array( "far" ),
			"warning"              => array( "exclamation-triangle" ),
			"calendar"             => array( "calendar-alt" ),
			"arrows-v"             => array( "arrows-alt-v" ),
			"arrows-h"             => array( "arrows-alt-h" ),
			"bar-chart"            => array( "far", "chart-bar" ),
			"bar-chart-o"          => array( "far", "chart-bar" ),
			"twitter-square"       => array( "fab" ),
			"facebook-square"      => array( "fab" ),
			"gears"                => array( "cogs" ),
			"thumbs-o-up"          => array( "far", "thumbs-up" ),
			"thumbs-o-down"        => array( "far", "thumbs-down" ),
			"heart-o"              => array( "far", "heart" ),
			"sign-out"             => array( "sign-out-alt" ),
			"linkedin-square"      => array( "fab", "linkedin" ),
			"thumb-tack"           => array( "thumbtack" ),
			"external-link"        => array( "external-link-alt" ),
			"sign-in"              => array( "sign-in-alt" ),
			"github-square"        => array( "fab" ),
			"lemon-o"              => array( "far", "lemon" ),
			"square-o"             => array( "far", "square" ),
			"bookmark-o"           => array( "far", "bookmark" ),
			"twitter"              => array( "fab" ),
			"facebook"             => array( "fab", "facebook-f" ),
			"facebook-f"           => array( "fab", "facebook-f" ),
			"github"               => array( "fab" ),
			"credit-card"          => array( "far" ),
			"feed"                 => array( "rss" ),
			"hdd-o"                => array( "far", "hdd" ),
			"hand-o-right"         => array( "far", "hand-point-right" ),
			"hand-o-left"          => array( "far", "hand-point-left" ),
			"hand-o-up"            => array( "far", "hand-point-up" ),
			"hand-o-down"          => array( "far", "hand-point-down" ),
			"arrows-alt"           => array( "expand-arrows-alt" ),
			"group"                => array( "users" ),
			"chain"                => array( "link" ),
			"scissors"             => array( "cut" ),
			"files-o"              => array( "far", "copy" ),
			"floppy-o"             => array( "far", "save" ),
			"navicon"              => array( "bars" ),
			"reorder"              => array( "bars" ),
			"pinterest"            => array( "fab" ),
			"pinterest-square"     => array( "fab" ),
			"google-plus-square"   => array( "fab" ),
			"google-plus"          => array( "fab", "google-plus-g" ),
			"money"                => array( "far", "money-bill-alt" ),
			"unsorted"             => array( "sort" ),
			"sort-desc"            => array( "sort-down" ),
			"sort-asc"             => array( "sort-up" ),
			"linkedin"             => array( "fab", "linkedin-in" ),
			"rotate-left"          => array( "undo" ),
			"legal"                => array( "gavel" ),
			"tachometer"           => array( "tachometer-alt" ),
			"dashboard"            => array( "tachometer-alt" ),
			"comment-o"            => array( "far", "comment" ),
			"comments-o"           => array( "far", "comments" ),
			"flash"                => array( "bolt" ),
			"clipboard"            => array( "far" ),
			"paste"                => array( "far", "clipboard" ),
			"lightbulb-o"          => array( "far", "lightbulb" ),
			"exchange"             => array( "exchange-alt" ),
			"cloud-download"       => array( "cloud-download-alt" ),
			"cloud-upload"         => array( "cloud-upload-alt" ),
			"bell-o"               => array( "far", "bell" ),
			"cutlery"              => array( "utensils" ),
			"file-text-o"          => array( "far", "file-alt" ),
			"building-o"           => array( "far", "building" ),
			"hospital-o"           => array( "far", "hospital" ),
			"tablet"               => array( "tablet-alt" ),
			"mobile"               => array( "mobile-alt" ),
			"mobile-phone"         => array( "mobile-alt" ),
			"circle-o"             => array( "far", "circle" ),
			"mail-reply"           => array( "reply" ),
			"github-alt"           => array( "fab" ),
			"folder-o"             => array( "far", "folder" ),
			"folder-open-o"        => array( "far", "folder-open" ),
			"smile-o"              => array( "far", "smile" ),
			"frown-o"              => array( "far", "frown" ),
			"meh-o"                => array( "far", "meh" ),
			"keyboard-o"           => array( "far", "keyboard" ),
			"flag-o"               => array( "far", "flag" ),
			"mail-reply-all"       => array( "reply-all" ),
			"star-half-o"          => array( "far", "star-half" ),
			"star-half-empty"      => array( "far", "star-half" ),
			"star-half-full"       => array( "far", "star-half" ),
			"code-fork"            => array( "code-branch" ),
			"chain-broken"         => array( "unlink" ),
			"shield"               => array( "shield-alt" ),
			"calendar-o"           => array( "far", "calendar" ),
			"maxcdn"               => array( "fab" ),
			"html5"                => array( "fab" ),
			"css3"                 => array( "fab" ),
			"ticket"               => array( "ticket-alt" ),
			"minus-square-o"       => array( "far", "minus-square" ),
			"level-up"             => array( "level-up-alt" ),
			"level-down"           => array( "level-down-alt" ),
			"pencil-square"        => array( "pen-square" ),
			"external-link-square" => array( "external-link-square-alt" ),
			"compass"              => array( "far" ),
			"caret-square-o-down"  => array( "far", "caret-square-down" ),
			"toggle-down"          => array( "far", "caret-square-down" ),
			"caret-square-o-up"    => array( "far", "caret-square-up" ),
			"toggle-up"            => array( "far", "caret-square-up" ),
			"caret-square-o-right" => array( "far", "caret-square-right" ),
			"toggle-right"         => array( "far", "caret-square-right" ),
			"eur"                  => array( "euro-sign" ),
			"euro"                 => array( "euro-sign" ),
			"gbp"                  => array( "pound-sign" ),
			"usd"                  => array( "dollar-sign" ),
			"dollar"               => array( "dollar-sign" ),
			"inr"                  => array( "rupee-sign" ),
			"rupee"                => array( "rupee-sign" ),
			"jpy"                  => array( "yen-sign" ),
			"cny"                  => array( "yen-sign" ),
			"rmb"                  => array( "yen-sign" ),
			"yen"                  => array( "yen-sign" ),
			"rub"                  => array( "ruble-sign" ),
			"ruble"                => array( "ruble-sign" ),
			"rouble"               => array( "ruble-sign" ),
			"krw"                  => array( "won-sign" ),
			"won"                  => array( "won-sign" ),
			"btc"                  => array( "fab" ),
			"bitcoin"              => array( "fab", "btc" ),
			"file-text"            => array( "file-alt" ),
			"sort-alpha-asc"       => array( "sort-alpha-down" ),
			"sort-alpha-desc"      => array( "sort-alpha-up" ),
			"sort-amount-asc"      => array( "sort-amount-down" ),
			"sort-amount-desc"     => array( "sort-amount-up" ),
			"sort-numeric-asc"     => array( "sort-numeric-down" ),
			"sort-numeric-desc"    => array( "sort-numeric-up" ),
			"youtube-square"       => array( "fab" ),
			"youtube"              => array( "fab" ),
			"xing"                 => array( "fab" ),
			"xing-square"          => array( "fab" ),
			"youtube-play"         => array( "fab", "youtube" ),
			"dropbox"              => array( "fab" ),
			"stack-overflow"       => array( "fab" ),
			"instagram"            => array( "fab" ),
			"flickr"               => array( "fab" ),
			"adn"                  => array( "fab" ),
			"bitbucket"            => array( "fab" ),
			"bitbucket-square"     => array( "fab", "bitbucket" ),
			"tumblr"               => array( "fab" ),
			"tumblr-square"        => array( "fab" ),
			"long-arrow-down"      => array( "long-arrow-alt-down" ),
			"long-arrow-up"        => array( "long-arrow-alt-up" ),
			"long-arrow-left"      => array( "long-arrow-alt-left" ),
			"long-arrow-right"     => array( "long-arrow-alt-right" ),
			"apple"                => array( "fab" ),
			"windows"              => array( "fab" ),
			"android"              => array( "fab" ),
			"linux"                => array( "fab" ),
			"dribbble"             => array( "fab" ),
			"skype"                => array( "fab" ),
			"foursquare"           => array( "fab" ),
			"trello"               => array( "fab" ),
			"gratipay"             => array( "fab" ),
			"gittip"               => array( "fab", "gratipay" ),
			"sun-o"                => array( "far", "sun" ),
			"moon-o"               => array( "far", "moon" ),
			"vk"                   => array( "fab" ),
			"weibo"                => array( "fab" ),
			"renren"               => array( "fab" ),
			"pagelines"            => array( "fab" ),
			"stack-exchange"       => array( "fab" ),
			"arrow-circle-o-right" => array( "far", "arrow-alt-circle-right" ),
			"arrow-circle-o-left"  => array( "far", "arrow-alt-circle-left" ),
			"caret-square-o-left"  => array( "far", "caret-square-left" ),
			"toggle-left"          => array( "far", "caret-square-left" ),
			"dot-circle-o"         => array( "far", "dot-circle" ),
			"vimeo-square"         => array( "fab" ),
			"try"                  => array( "lira-sign" ),
			"turkish-lira"         => array( "lira-sign" ),
			"plus-square-o"        => array( "far", "plus-square" ),
			"slack"                => array( "fab" ),
			"wordpress"            => array( "fab" ),
			"openid"               => array( "fab" ),
			"institution"          => array( "university" ),
			"bank"                 => array( "university" ),
			"mortar-board"         => array( "graduation-cap" ),
			"yahoo"                => array( "fab" ),
			"google"               => array( "fab" ),
			"reddit"               => array( "fab" ),
			"reddit-square"        => array( "fab" ),
			"stumbleupon-circle"   => array( "fab" ),
			"stumbleupon"          => array( "fab" ),
			"delicious"            => array( "fab" ),
			"digg"                 => array( "fab" ),
			"pied-piper-pp"        => array( "fab" ),
			"pied-piper-alt"       => array( "fab" ),
			"drupal"               => array( "fab" ),
			"joomla"               => array( "fab" ),
			"spoon"                => array( "utensil-spoon" ),
			"behance"              => array( "fab" ),
			"behance-square"       => array( "fab" ),
			"steam"                => array( "fab" ),
			"steam-square"         => array( "fab" ),
			"automobile"           => array( "car" ),
			"cab"                  => array( "taxi" ),
			"envelope-o"           => array( "far", "envelope" ),
			"deviantart"           => array( "fab" ),
			"soundcloud"           => array( "fab" ),
			"file-pdf-o"           => array( "far", "file-pdf" ),
			"file-word-o"          => array( "far", "file-word" ),
			"file-excel-o"         => array( "far", "file-excel" ),
			"file-powerpoint-o"    => array( "far", "file-powerpoint" ),
			"file-image-o"         => array( "far", "file-image" ),
			"file-photo-o"         => array( "far", "file-image" ),
			"file-picture-o"       => array( "far", "file-image" ),
			"file-archive-o"       => array( "far", "file-archive" ),
			"file-zip-o"           => array( "far", "file-archive" ),
			"file-audio-o"         => array( "far", "file-audio" ),
			"file-sound-o"         => array( "far", "file-audio" ),
			"file-video-o"         => array( "far", "file-video" ),
			"file-movie-o"         => array( "far", "file-video" ),
			"file-code-o"          => array( "far", "file-code" ),
			"vine"                 => array( "fab" ),
			"codepen"              => array( "fab" ),
			"jsfiddle"             => array( "fab" ),
			"life-ring"            => array( "far" ),
			"life-bouy"            => array( "far", "life-ring" ),
			"life-buoy"            => array( "far", "life-ring" ),
			"life-saver"           => array( "far", "life-ring" ),
			"support"              => array( "far", "life-ring" ),
			"circle-o-notch"       => array( "circle-notch" ),
			"rebel"                => array( "fab" ),
			"ra"                   => array( "fab", "rebel" ),
			"resistance"           => array( "fab", "rebel" ),
			"empire"               => array( "fab" ),
			"ge"                   => array( "fab", "empire" ),
			"git-square"           => array( "fab" ),
			"git"                  => array( "fab" ),
			"hacker-news"          => array( "fab" ),
			"y-combinator-square"  => array( "fab", "hacker-news" ),
			"yc-square"            => array( "fab", "hacker-news" ),
			"tencent-weibo"        => array( "fab" ),
			"qq"                   => array( "fab" ),
			"weixin"               => array( "fab" ),
			"wechat"               => array( "fab", "weixin" ),
			"send"                 => array( "paper-plane" ),
			"paper-plane-o"        => array( "far", "paper-plane" ),
			"send-o"               => array( "far", "paper-plane" ),
			"circle-thin"          => array( "far", "circle" ),
			"header"               => array( "heading" ),
			"sliders"              => array( "sliders-h" ),
			"futbol-o"             => array( "far", "futbol" ),
			"soccer-ball-o"        => array( "far", "futbol" ),
			"slideshare"           => array( "fab" ),
			"twitch"               => array( "fab" ),
			"yelp"                 => array( "fab" ),
			"newspaper-o"          => array( "far", "newspaper" ),
			"paypal"               => array( "fab" ),
			"google-wallet"        => array( "fab" ),
			"cc-visa"              => array( "fab" ),
			"cc-mastercard"        => array( "fab" ),
			"cc-discover"          => array( "fab" ),
			"cc-amex"              => array( "fab" ),
			"cc-paypal"            => array( "fab" ),
			"cc-stripe"            => array( "fab" ),
			"bell-slash-o"         => array( "far", "bell-slash" ),
			"trash"                => array( "trash-alt" ),
			"copyright"            => array( "far" ),
			"eyedropper"           => array( "eye-dropper" ),
			"area-chart"           => array( "chart-area" ),
			"pie-chart"            => array( "chart-pie" ),
			"line-chart"           => array( "chart-line" ),
			"lastfm"               => array( "fab" ),
			"lastfm-square"        => array( "fab" ),
			"ioxhost"              => array( "fab" ),
			"angellist"            => array( "fab" ),
			"cc"                   => array( "far", "closed-captioning" ),
			"ils"                  => array( "shekel-sign" ),
			"shekel"               => array( "shekel-sign" ),
			"sheqel"               => array( "shekel-sign" ),
			"meanpath"             => array( "fab", "font-awesome" ),
			"buysellads"           => array( "fab" ),
			"connectdevelop"       => array( "fab" ),
			"dashcube"             => array( "fab" ),
			"forumbee"             => array( "fab" ),
			"leanpub"              => array( "fab" ),
			"sellsy"               => array( "fab" ),
			"shirtsinbulk"         => array( "fab" ),
			"simplybuilt"          => array( "fab" ),
			"skyatlas"             => array( "fab" ),
			"diamond"              => array( "far", "gem" ),
			"intersex"             => array( "transgender" ),
			"facebook-official"    => array( "fab", "facebook" ),
			"pinterest-p"          => array( "fab" ),
			"whatsapp"             => array( "fab" ),
			"hotel"                => array( "bed" ),
			"viacoin"              => array( "fab" ),
			"medium"               => array( "fab" ),
			"y-combinator"         => array( "fab" ),
			"yc"                   => array( "fab", "y-combinator" ),
			"optin-monster"        => array( "fab" ),
			"opencart"             => array( "fab" ),
			"expeditedssl"         => array( "fab" ),
			"battery-4"            => array( "battery-full" ),
			"battery"              => array( "battery-full" ),
			"battery-3"            => array( "battery-three-quarters" ),
			"battery-2"            => array( "battery-half" ),
			"battery-1"            => array( "battery-quarter" ),
			"battery-0"            => array( "battery-empty" ),
			"object-group"         => array( "far" ),
			"object-ungroup"       => array( "far" ),
			"sticky-note-o"        => array( "far", "sticky-note" ),
			"cc-jcb"               => array( "fab" ),
			"cc-diners-club"       => array( "fab" ),
			"clone"                => array( "far" ),
			"hourglass-o"          => array( "far", "hourglass" ),
			"hourglass-1"          => array( "hourglass-start" ),
			"hourglass-2"          => array( "hourglass-half" ),
			"hourglass-3"          => array( "hourglass-end" ),
			"hand-rock-o"          => array( "far", "hand-rock" ),
			"hand-grab-o"          => array( "far", "hand-rock" ),
			"hand-paper-o"         => array( "far", "hand-paper" ),
			"hand-stop-o"          => array( "far", "hand-paper" ),
			"hand-scissors-o"      => array( "far", "hand-scissors" ),
			"hand-lizard-o"        => array( "far", "hand-lizard" ),
			"hand-spock-o"         => array( "far", "hand-spock" ),
			"hand-pointer-o"       => array( "far", "hand-pointer" ),
			"hand-peace-o"         => array( "far", "hand-peace" ),
			"registered"           => array( "far" ),
			"creative-commons"     => array( "fab" ),
			"gg"                   => array( "fab" ),
			"gg-circle"            => array( "fab" ),
			"tripadvisor"          => array( "fab" ),
			"odnoklassniki"        => array( "fab" ),
			"odnoklassniki-square" => array( "fab" ),
			"get-pocket"           => array( "fab" ),
			"wikipedia-w"          => array( "fab" ),
			"safari"               => array( "fab" ),
			"chrome"               => array( "fab" ),
			"firefox"              => array( "fab" ),
			"opera"                => array( "fab" ),
			"internet-explorer"    => array( "fab" ),
			"television"           => array( "tv" ),
			"contao"               => array( "fab" ),
			"500px"                => array( "fab" ),
			"amazon"               => array( "fab" ),
			"calendar-plus-o"      => array( "far", "calendar-plus" ),
			"calendar-minus-o"     => array( "far", "calendar-minus" ),
			"calendar-times-o"     => array( "far", "calendar-times" ),
			"calendar-check-o"     => array( "far", "calendar-check" ),
			"map-o"                => array( "far", "map" ),
			"commenting"           => array( "far", "comment-dots" ),
			"commenting-o"         => array( "far", "comment-dots" ),
			"houzz"                => array( "fab" ),
			"vimeo"                => array( "fab", "vimeo-v" ),
			"black-tie"            => array( "fab" ),
			"fonticons"            => array( "fab" ),
			"reddit-alien"         => array( "fab" ),
			"edge"                 => array( "fab" ),
			"credit-card-alt"      => array( "credit-card" ),
			"codiepie"             => array( "fab" ),
			"modx"                 => array( "fab" ),
			"fort-awesome"         => array( "fab" ),
			"usb"                  => array( "fab" ),
			"product-hunt"         => array( "fab" ),
			"mixcloud"             => array( "fab" ),
			"scribd"               => array( "fab" ),
			"pause-circle-o"       => array( "far", "pause-circle" ),
			"stop-circle-o"        => array( "far", "stop-circle" ),
			"bluetooth"            => array( "fab" ),
			"bluetooth-b"          => array( "fab" ),
			"gitlab"               => array( "fab" ),
			"wpbeginner"           => array( "fab" ),
			"wpforms"              => array( "fab" ),
			"envira"               => array( "fab" ),
			"wheelchair-alt"       => array( "fab", "accessible-icon" ),
			"question-circle-o"    => array( "far", "question-circle" ),
			"volume-control-phone" => array( "phone-volume" ),
			"asl-interpreting"     => array( "american-sign-language-interpreting" ),
			"deafness"             => array( "deaf" ),
			"hard-of-hearing"      => array( "deaf" ),
			"glide"                => array( "fab" ),
			"glide-g"              => array( "fab" ),
			"signing"              => array( "sign-language" ),
			"viadeo"               => array( "fab" ),
			"viadeo-square"        => array( "fab" ),
			"snapchat"             => array( "fab" ),
			"snapchat-ghost"       => array( "fab" ),
			"snapchat-square"      => array( "fab" ),
			"pied-piper"           => array( "fab" ),
			"first-order"          => array( "fab" ),
			"yoast"                => array( "fab" ),
			"themeisle"            => array( "fab" ),
			"google-plus-official" => array( "fab", "google-plus" ),
			"google-plus-circle"   => array( "fab", "google-plus" ),
			"font-awesome"         => array( "fab" ),
			"fa"                   => array( "fab", "font-awesome" ),
			"handshake-o"          => array( "far", "handshake" ),
			"envelope-open-o"      => array( "far", "envelope-open" ),
			"linode"               => array( "fab" ),
			"address-book-o"       => array( "far", "address-book" ),
			"vcard"                => array( "address-card" ),
			"address-card-o"       => array( "far", "address-card" ),
			"vcard-o"              => array( "far", "address-card" ),
			"user-circle-o"        => array( "far", "user-circle" ),
			"user-o"               => array( "far", "user" ),
			"id-badge"             => array( "far" ),
			"drivers-license"      => array( "id-card" ),
			"id-card-o"            => array( "far", "id-card" ),
			"drivers-license-o"    => array( "far", "id-card" ),
			"quora"                => array( "fab" ),
			"free-code-camp"       => array( "fab" ),
			"telegram"             => array( "fab" ),
			"thermometer-4"        => array( "thermometer-full" ),
			"thermometer"          => array( "thermometer-full" ),
			"thermometer-3"        => array( "thermometer-three-quarters" ),
			"thermometer-2"        => array( "thermometer-half" ),
			"thermometer-1"        => array( "thermometer-quarter" ),
			"thermometer-0"        => array( "thermometer-empty" ),
			"bathtub"              => array( "bath" ),
			"s15"                  => array( "bath" ),
			"window-maximize"      => array( "far" ),
			"window-restore"       => array( "far" ),
			"times-rectangle"      => array( "window-close" ),
			"window-close-o"       => array( "far", "window-close" ),
			"times-rectangle-o"    => array( "far", "window-close" ),
			"bandcamp"             => array( "fab" ),
			"grav"                 => array( "fab" ),
			"etsy"                 => array( "fab" ),
			"imdb"                 => array( "fab" ),
			"ravelry"              => array( "fab" ),
			"eercast"              => array( "fab", "sellcast" ),
			"snowflake-o"          => array( "far", "snowflake" ),
			"superpowers"          => array( "fab" ),
			"wpexplorer"           => array( "fab" ),
			"spotify"              => array( "fab" )
		);
		if ( isset( $list_icons[ $old ] ) ) {
			if( isset( $list_icons[ $old ][ 0 ] ) ){
				if( ( $list_icons[ $old ][ 0 ] == "fab" ) || ( $list_icons[ $old ][ 0 ] == "far" ) ){
					if( isset( $list_icons[ $old ][ 1 ] ) ){
						return $list_icons[ $old ][ 0 ] . ' fa-' . $list_icons[ $old ][ 1 ];
					}
					else{
						return $list_icons[ $old ][ 0 ] . ' fa-' . $old;
					}
				}
				else{
					return 'fas fa-' . $list_icons[ $old ][ 0 ];
				}
			}
		}
		return 'fas fa-' . $old;
	}
}