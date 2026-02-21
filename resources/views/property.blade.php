@extends('layouts.default')
@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
          rel="stylesheet">
    <link href="{{asset('css/view-propery.css')}}" rel="stylesheet"/>

    <!-- Fotorama from CDNJS, 19 KB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <style>
        .feature-property-img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
    <style>
        /* Custom CSS Vars */
        .card-top-nav, #mobile-nav { --nav-link-color: rgba(255,255,255,1); }
        .card-top-header { --player-icons-color: rgba(0,0,0,1); }
        .card-price-features { --heading-color: inherit; }
        .card-prop-description .desc { --columns: 1; }
        .card-areas { --heading-color: inherit; }
        .card-site-footer { --footer-bg-color: inherit; }
        .card-top-nav, #mobile-nav { --nav-link-color-scroll: rgba(0,0,0,1); }
        .card-top-header { --player-controls-bgcolor: rgba(255,255,255,0.8); }
        .card-price-features { --body-copy-color: inherit; }
        .card-prop-description { --heading-color: inherit; }
        .card-amenities { --heading-color: inherit; }
        .card-photos { --display-slideshow: block; }
        .card-video { --heading-color: inherit; }
        .card-documents { --heading-color: inherit; }
        .card-flyers { --heading-color: inherit; }
        .card-map { --heading-color: inherit; }
        .card-areas { --body-link-color: inherit; }
        .card-agent { --heading-color: inherit; }
        .card-contact-form { --heading-color: inherit; }
        .card-site-footer { --footer-text-color: ; }
        .card-floor-plans { --heading-color: inherit; }
        .card-top-nav { --nav-bg-color: rgba(0,0,0,0); }
        .card-top-header { --video-aspect-ratio: 16/9; }
        .card-price-features { --btn-icon-color: inherit; }
        .card-prop-description { --body-copy-color: inherit; }
        .card-amenities { --body-copy-color: inherit; }
        .card-photos .grid .photo { --border-width: 16px; }
        .card-video { --section-bgcolor: inherit; }
        .card-documents { --body-link-color: inherit; }
        .card-flyers { --body-link-color: inherit; }
        .card-map { --nav-link-color: inherit; }
        .card-areas { --body-copy-color: inherit; }
        .card-agent { --body-copy-color: inherit; }
        .card-site-footer { --nav-link-color: rbga(108,117,125,1); }
        .card-units { --heading-color: inherit; }
        .card-floor-plans { --section-bgcolor: inherit; }
        .card-top-nav, #mobile-nav { --nav-bg-color-scroll: rgba(255,255,255,1); }
        .card-top-header { --heading-color: inherit; }
        .card-price-features { --section-bgcolor: inherit; }
        .card-prop-description { --body-link-color: inherit; }
        .card-amenities { --section-bgcolor: inherit; }
        .card-photos .grid .photo { --photo-bg-color: rgba(255,255,255,1); }
        .card-documents { --body-copy-color: inherit; }
        .card-flyers { --body-copy-color: inherit; }
        .card-map { --tab-selected-bg-color: rgba(227,227,227,1); }
        .card-areas { --thumb-border: rgba(222,226,230,1); }
        .card-agent { --body-link-color: inherit; }
        .card-contact-form { --btn-icon-color: inherit; }
        .card-units { --body-copy-color: inherit; }
        .card-floor-plans { --box-tab-border-color: rgba(222,226,230,1); }
        .card-top-nav { --justify-nav-links: center; }
        .card-prop-description { --section-bgcolor: inherit; }
        .card-amenities { --btn-icon-color: inherit; }
        .card-photos { --thumb-border-radius: 3px; }
        .card-documents { --btn-icon-color: inherit; }
        .card-flyers { --section-bgcolor: inherit; }
        .card-map { --tab-border-radius: 3px; }
        .card-areas { --thumb-border-radius: 3px; }
        .card-agent { --btn-icon-color: inherit; }
        .card-contact-form { --btn-text-color: ; }
        .card-site-footer { --logo-max-height: 125px; }
        .card-units { --body-link-color: inherit; }
        .card-floor-plans { --body-link-color: inherit; }
        .card-top-nav { --nav-border-bottom: rgba(0,0,0,0.15); }
        .card-top-header { --display-address: flex; }
        .card-amenities { --box-border-color: rgb(33,37,41); }
        .card-photos { --heading-color: inherit; }
        .card-open-house { --heading-color: inherit; }
        .card-documents { --section-bgcolor: inherit; }
        .card-map { --section-bgcolor: inherit; }
        .card-areas { --divider-color: rgba(222,226,230,1); }
        .card-agent { --photo-border-radius: 1%; }
        .card-contact-form { --accent-line-color: rgba(222,226,230,1); }
        .card-site-footer { --logo-max-width: 300px; }
        .card-units { --section-bgcolor: inherit; }
        .card-floor-plans { --body-copy-color: inherit; }
        .card-top-header { --section-bgcolor: rgba(250,250,250,1); }
        .card-photos { --section-bgcolor: inherit; }
        .card-open-house { --body-copy-color: inherit; }
        .card-areas { --section-bgcolor: inherit; }
        .card-agent { --section-bgcolor: inherit; }
        .card-contact-form { --box-bg-color: rgba(255,255,255,0.95); }
        .card-photos { --btn-icon-color: inherit; }
        .card-open-house { --btn-icon-color: inherit; }
        .card-contact-form { --box-border-radius: 4px; }
        .card-photos { --body-link-color: inherit; }
        .card-open-house { --btn-text-color: inherit; }
        .card-open-house { --accent-line-color: rgba(222,226,230,1); }
        .card-open-house { --box-bg-color: rgba(255,255,255,0.95); }
        .card-open-house { --box-border-radius: 4px; }
        .card-open-house { --btn-border-radius: 2px; }
        .card-top-nav {
            position: fixed;
            top: 0px;
            z-index: 99;
            background-color: var(--nav-bg-color, rgba(0,0,0,0));
            border-bottom: 1px solid transparent;
        }
        .card-top-nav .container-fluid {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: var(--justify-nav-links, center);
        }
        .card-top-nav a {
            color: var(--nav-link-color, rgba(255,255,255,1));
            transition: ease-in-out color .15s;
            border-bottom: 1px solid transparent;
        }
        .card-top-nav a:hover {
            color: var(--nav-link-color);
            text-decoration: none;
        }
        .card-top-nav a.nav-link {
            padding: 0.5rem 0.5rem;
            margin-inline: 0.5rem;
        }
        .card-top-nav.active,
        .card-top-nav.mobile-menu-open {
            background-color: var(--nav-bg-color-scroll, rgba(255,255,255,1));
            transition: ease-in-out color .15s;
            border-bottom: 1px solid var(--nav-border-bottom, rgba(0,0,0,0.15));
        }
        .card-top-nav.active a,
        .card-top-nav.active svg {
            color: var(--nav-link-color-scroll);
            transition: ease-in-out color .15s;
        }
        .card-top-nav.active a:hover,
        .card-top-nav.active a:visited {
            text-decoration: none;
        }
        .card-top-nav a.nav-link.active {
            border-bottom: 1px solid var(--nav-link-color);
        }
        .card-top-nav.active a.nav-link:hover,
        .card-top-nav.active a.nav-link.active {
            border-bottom: 1px solid var(--nav-link-color-scroll);
        }
        .card-top-nav .nav-mobile-address {
            display: none;
        }
        .card-top-nav h5.nav-mobile-address {
            color: var(--nav-link-color-scroll);
            padding-top: 10px;
        }
        .card-top-nav.active .nav-mobile-address,
        .card-top-nav.mobile-menu-open .nav-mobile-address {
            display: block;
        }
        .card-top-nav .x-icon {
            display: none;
        }
        .card-top-nav .burger-icon {
            color: var(--nav-link-color);
            transition: ease-in-out color .15s;
        }
        .card-top-nav .x-icon {
            color: var(--nav-link-color-scroll);
            transition: ease-in-out color .15s;
        }
        .card-top-nav.active .burger-icon,
        .card-top-nav.active .x-icon {
            color: var(--nav-link-color-scroll);
            transition: ease-in-out color .15s;
        }
        /* Mobile Menu */
        .nav-mobile { z-index: 99; }
        .overlay {
            display: block;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: var(--nav-bg-color-scroll, rgba(255,255,255,1));
            z-index: 98;
        }
        .overlay nav {
            background-color: none;
        }
        .overlay nav .nav-mobile-link {
            font-size: 1.25rem;
        }
        @media only screen and (max-width: 576px) {
            .overlay nav .nav-mobile-link {
                font-size: 1.0rem;
            }
        }
        @media only screen and (max-width: 400px) {
            .card-top-nav .nav-mobile-address {
                font-size: 1.0rem;
            }
            .overlay nav .nav-mobile-link {
                font-size: 1.0rem;
            }
        }
        .overlay ul {
            list-style: none;
            margin: 0 auto;
        }
        .overlay ul li {
            padding-block: 2px;
        }
        .overlay ul li a {
            font-weight: bold;
            text-decoration: none;
            color: var(--nav-link-color-scroll);
        }
        .overlay-data {
            opacity: 0;
            visibility: hidden;
            -webkit-transition: opacity 0.5s;
            transition: opacity 0.5s;
        }
        .overlay-open {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.5s;
            transition: opacity 0.5s;
            padding-left: 25px;
            padding-top: 90px;
        }
        .card-top-header {
            width: 100%;
            position: relative;
            background-color: var(--section-bgcolor);
        }
        .card-top-header .hero-content {
            position: absolute;
            z-index: 11;
            display:none;
        }
        .card-top-header h1,
        .card-top-header h4,
        .card-top-header h5 {
            color: var(--heading-color);
            text-align: center;
            margin-bottom: 0;
        }
        .card-top-header .display-address {
            padding-top: 15px;
            display: var(--display-address, flex);
            align-items: center;
            justify-content: center;
        }
        .card-top-header .horiz-line {
            border-top: 1px solid var(--heading-color);
        }
        .card-top-header .video-ar {
            aspect-ratio: var(--video-aspect-ratio, 16/9);
            position: relative;
            overflow: hidden;
            padding: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .card-top-header .video-wrapper {
            position:absolute;
            top:0;
            left:0;
            height:100%;
            width:100%;
        }
        .card-top-header .vid-mobile {
            background-color: #fafafa;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 72px;
            height:100%;
            width:100%;
        }
        .card-top-header .video-controls {
            position:absolute;
            bottom: 4px;
            width: 100%;
            z-index: 11;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-top-header .video-controls .btn-bar {
            border-radius: 4px;
            padding: 5px 5px 5px 5px;
            text-align: center;
            background-color: var(--player-controls-bgcolor, rgba(255,255,255,0.8));
            color: var(--player-icons-color, rgba(0,0,0,1));
        }
        .card-top-header .video-controls .mobile-fallback {
            display: none;
            color: var(--heading-overlay-color);
        }
        /* .video-overlay {
        height: 100%;
        position: absolute;
        width: 100%;
        z-index: 2;
        background-color: #000;
        opacity: .50
        } */
        /* .video-overlay.video-playing {
        height: 100%;
        position: absolute;
        width: 100%;
        z-index: 2;
        background-color: #000;
        opacity: 0;
        } */
        .tv {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .tv .screen {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            margin: auto;
            opacity: 0;
            transition: opacity .5s;
        }
        .tv .screen.active {
            opacity: 1;
        }
        .tv .screen iframe {
            width: 100%;
            height: 100%;
        }
        .wistia_video_foam_dummy {
            width: 100% !important;
        }
        /* price-features-04.css */
        .card-price-features h1 {
            font-size: 2rem;
        }
        .card-price-features::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-price-features p,
        .card-price-features div {
            color: var(--body-copy-color);
        }
        .card-prop-description::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-prop-description h1 {
            margin-bottom: 35px;
            text-align: center;
        }
        .card-prop-description .desc {
            columns: var(--columns, 1);
            column-gap: 35px;
            color: var(--body-copy-color, inherit);
        }
        .card-prop-description .desc p:last-of-type {
            margin-bottom: 0;
        }
        .card-prop-description .desc a {
            color: var(--body-link-color, inherit);
        }
        @media (max-width: 767.98px) {
            .card-prop-description .desc {
                columns: 1;
            }
        }
        .card-amenities::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-amenities .amenities-border {
            border: 1px solid var(--box-border-color, #212529);
        }
        .card-amenities .amenities-title {
            margin-top: -25px;
            width: fit-content;
            margin-inline: auto;
        }
        .card-amenities .amenities-title h1 {
            background-color: var(--section-bgcolor);
            padding-inline: 15px;
        }
        .card-amenities .amenity-name {
            color: var(--body-copy-color);
        }
        /* photos-05.css */
        .card-photos::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-photos .grid {
            --column-gap: 20px;
            --row-gap: 30px;
        }
        .card-photos .grid {
            padding-top: 35px;
            display: flex;
            flex-wrap: wrap;
            column-gap: var(--column-gap);
            row-gap: var(--row-gap);
            align-items: center;
            margin-inline: 5vw;
        }
        .card-photos .grid .item {
            flex-basis: calc(20% - var(--column-gap));
        }
        .card-photos .grid .photo {
            background-color: var(--photo-bg-color, rgba(255,255,255,1));
            padding: var(--border-width, 16px);
            margin-inline: auto;
            box-sizing: border-box;
            box-shadow: 2px 2px 4px 0 #ccc;
            border-radius: 4px;
            width: fit-content;
            border-radius: var(--thumb-border-radius, 3px);
            /* border: 1px solid #fafafa; */
        }
        .card-photos .grid .photo img {
            max-height: 200px;
            border-radius: var(--thumb-border-radius, 3px);
        }
        .card-photos .d-slideshow {
            display: var(--display-slideshow, block);
        }
        .card-photos a {
            color: var(--body-link-color);
        }
        @media (max-width: 1499.98px) {
            .card-photos .grid .item {
                flex-basis: calc(25% - var(--column-gap));
            }
        }
        @media (max-width: 1199.98px) {
            .card-photos .grid .item {
                flex-basis: calc(25% - var(--column-gap));
            }
        }
        @media (max-width: 991.98px) {
            .card-photos .grid .item {
                flex-basis: calc(50% - var(--column-gap));
            }
        }
        @media (max-width: 767.98px) {
            .card-photos .grid .item {
                flex-basis: calc(50% - var(--column-gap));
            }
        }
        @media (max-width: 575.98px) {
            .card-photos .grid .item {
                flex-basis: calc(50% - var(--column-gap));
            }
        }
        @media (max-width: 499.98px) {
            .card-photos .grid .item {
                flex-basis: calc(50% - var(--column-gap));
            }
        }
        @media (max-width: 419.98px) {
            .card-photos .grid .item {
                flex-basis: calc(100% - var(--column-gap));
            }
        }
        /* video-02.css */
        .card-video::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-documents::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-documents h1 {
            text-align: center;
        }
        .card-documents a.doc-link {
            color: var(--body-link-color);
        }
        .card-documents .short-desc {
            color: var(--body-copy-color);
        }
        .card-documents .img-thumbnail {
            height: 100px;
        }
        .card-floor-plans::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-floor-plans .fp-image {
            position: relative;
            width: fit-content;
            margin-inline: auto;
        }
        .card-floor-plans .fp-image .photo-box {
            position: absolute;
            z-index: 6;
            border: 2px solid rgb(87,75,53);
            background-color: rgba(139, 134, 122, 0.4);
            text-align:left;
            cursor: pointer;
            display: flex;
            align-items: flex-start;
            align-content: flex-start;
        }
        .card-floor-plans .fp-image .photo-box:hover {
            background-color: rgba(87,75,53, 0.5);
        }
        .card-floor-plans .fp-image .remove-box {
            text-decoration: none;
            background-color: rgba(0,0,0,0.4);
            color: #fafafa;
            display:none;
            padding: 0px 4px;
            cursor: pointer;
        }
        .card-floor-plans .fp-image .num-photos {
            background-color: rgba(87,75,53, 0.9);
            padding: 0px 4px;
            color: #fafafa;
        }
        .card-floor-plans .tab-content {
            border-left: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
            border-right: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
            border-bottom: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
        }
        .card-floor-plans .tab-content.just-one {
            border-top: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
        }
        .card-floor-plans .nav-tabs {
            border-bottom: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
        }
        .card-floor-plans .nav-tabs .nav-link {
            color: var(--body-link-color);
        }
        .card-floor-plans .nav-tabs .nav-link:hover {
            border-color: transparent;
        }
        .card-floor-plans .nav-tabs .nav-link.active,
        .card-floor-plans .nav-tabs .nav-link.active:hover {
            color: var(--body-copy-color);
            border-left: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
            border-right: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
            border-top: 1px solid var(--box-tab-border-color, rgba(222, 226, 230, 1));
            border-bottom: 1px solid transparent;
            background-color: var(--section-bgcolor, #fafafa);
        }
        .mfp-fade.mfp-bg {
            opacity: 0;
            -webkit-transition: all 0.15s ease-out;
            -moz-transition: all 0.15s ease-out;
            transition: all 0.15s ease-out;
        }
        .mfp-fade.mfp-bg.mfp-ready {
            opacity: 0.5;
        }
        .mfp-fade.mfp-bg.mfp-removing {
            opacity: 0;
        }
        .mfp-fade.mfp-wrap .mfp-content {
            opacity: 0;
            -webkit-transition: all 0.15s ease-out;
            -moz-transition: all 0.15s ease-out;
            transition: all 0.15s ease-out;
        }
        .mfp-fade.mfp-wrap.mfp-ready .mfp-content {
            opacity: 1;
        }
        .mfp-fade.mfp-wrap.mfp-removing .mfp-content {
            opacity: 0;
        }
        /* multiple-units-01.css */
        .card-units::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-units .row-units {
            padding-top: 40px;
            padding-bottom: 40px;
            --grid-gap: 65px;
            justify-content: center;
        }
        .card-units .grid-units {
            display: flex;
            column-gap: var(--grid-gap);
            row-gap: var(--grid-gap);
            flex-wrap: wrap;
            justify-content: center;
            /* align-items: center; */
        }
        .card-units .grid-units .unit {
            flex-basis: calc(33% - 42px);
            border-radius: 4px;
            overflow: hidden;
        }
        .card-units .grid-units .unit a {
            color: var(--body-link-color);
        }
        .card-units .grid-units .unit a:hover {
            text-decoration: none;
        }
        .card-units p.unitname {
            font-size: 1.2rem;
            /* font-family: var(--headlines-font); */
            font-weight: var(--headlines-font-weight);
            text-align: center;
            margin-bottom: 8px;
            color: var(--body-link-color);
            text-decoration: underline;
        }
        .card-units .grid-units .unit:hover p.unitname,
        .card-units p.unitname:hover {
            color: var(--body-link-color);
            text-decoration: underline;
        }
        .card-units .info {
            padding: 10px 0px 10px 0px;
            text-align: center;
            color: var(--body-copy-color);
            font-size: 0.9rem;
        }
        @media (max-width: 1199.98px) {}
        @media (max-width: 991.98px) {
            .card-units .grid-units .unit {
                flex-basis: calc(50% - 38px);
            }
        }
        @media (max-width: 767.98px) {
            .card-units .grid-units .unit {
                flex-basis: 85%;
            }
            .card-units .grid-units {
                row-gap: 35px;
            }
        }
        @media (max-width: 575.98px) {
            .card-units .grid-units .unit {
                flex-basis: 95%;
            }
        }
        @media (max-width: 419.98px) {
            .card-units .grid-units .unit {
                flex-basis: 100%;
            }
        }
        .card-map::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-map .map-controls a {
            cursor: pointer;
            border-radius: 0;
            padding: 0.5rem 0.75rem;
            color: var(--nav-link-color);
        }
        .card-map .map-controls a:hover {
            color: var(--nav-link-color);
        }
        .card-map .nav-pills {
            padding-bottom: 15px;
        }
        .card-map .nav-pills li {
            border-radius: var(--tab-border-radius, 3px);
            overflow: hidden;
        }
        .card-map .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--nav-link-color);
            background-color: var(--tab-selected-bg-color, rgba(227,227,227,1));
        }
        .card-map .map-container.no-bar {
            margin-top: 35px;
        }
        .card-map .info-window-property-detail {
            font-weight: bold;
            font-size: 12px;
            color: #aaa;
        }
        .card-map .info-window-address { font-size: 16px; line-height: 1.1em; margin-bottom: 0px; }
        .card-map .map-container { position: relative; }
        .card-map .map-container .info-box {
            z-index:5; position:absolute; top: 12px; left:12px; height:88px; width: 297px; background-color:#fff; color: #222;
        }
        #gMap { border:0; margin-bottom:-7px; overflow:hidden; height:600px; width:100%; }
        .card-areas::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--section-bgcolor);
        }
        .card-areas .thumb-border {
            border: 1px solid var(--thumb-border, rgba(222,226,230,1));
            border-radius: var(--thumb-border-radius, 3px);
            overflow: hidden;
        }
        .card-areas .img-area-thumb {
            max-width: 150px;
            border-radius: var(--thumb-border-radius, 3px);
            overflow: hidden;
        }
        .card-areas .area-desc {
            color: var(--body-copy-color);
        }
        .card-areas .area-desc a {
            color: var(--body-link-color);
        }
        .card-areas .area-divider {
            width: 30%;
            border-top: 1px solid var(--divider-color, rgba(222,226,230,1));
        }
        .mfp-content {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .mfp-bottom-bar {
            padding-left: 10px;
            background-color: rgba(0, 0, 0, 0.8);
            margin-top: -40px;
            padding-block: 10px;
        }
        .mfp-counter {
            top: 10px;
            right: 10px;
            font-weight: bold;
        }
        .mfp-arrow-right:before {
            border-left: 27px solid rgba(0,0,0,0.2);
        }
        .mfp-arrow-left:before {
            border-right: 27px solid rgba(0,0,0,0.2);
        }
        .mfp-image-holder .mfp-close, .mfp-iframe-holder .mfp-close {
            right: 0px;
            padding-right: 5px;
        }
        @media (max-width: 991.98px) {
            .img-area-thumb {
                max-width: 100px;
            }
        }
        @media (max-width: 767.98px) {
            .card-site-footer img.footer-team-logo {
                /* max-width: 100%; */
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            // Add code for Adjust property gallery image div height
            let width = window.innerWidth;
            $("body").addClass('propery-view');
        });
        {{--        @if($data != 0)--}}
        {{--        function floorplan_tab(sequence) {--}}
        {{--            // SELECT FLOORPLAN IMAGE PARENT DIV--}}
        {{--            //$(".floorplan").hide();--}}
        {{--            //$("#floorplan" + sequence).show();--}}

        {{--            var buttons = document.querySelectorAll("button");--}}

        {{--            var buttons = document.querySelectorAll('.btn');--}}
        {{--            buttons.forEach(button => {--}}
        {{--                button.addEventListener('click', seatFunction, false);--}}
        {{--            });--}}

        {{--            function seatFunction() {--}}
        {{--                buttons.forEach(btn => btn.classList.remove('active'));--}}
        {{--                this.classList.add('active');--}}
        {{--            }--}}

        {{--            $(".floorplan").css("visibility", "hidden")--}}
        {{--            $("#floorplan" + sequence).css("visibility", "visible");--}}

        {{--            if (sequence == 1) {--}}
        {{--                //set the max margin on first load itself. no need to set on each click--}}
        {{--                setTimeout(function () {--}}
        {{--                    height = 0;--}}
        {{--                    $(".floorplan_tab").each(function () {--}}
        {{--                        tmp = $(this).height();--}}
        {{--                        if (tmp > height) height = tmp;--}}
        {{--                    });--}}

        {{--                    //Add some margin to the height to show whitespace--}}
        {{--                    height = height + 80;--}}

        {{--                    $("#fllorplan_margin").css('margin-top', height);--}}

        {{--                    floorplanImagesData(property_hotspot_details[0]);--}}

        {{--                }, 1000);--}}
        {{--            }--}}

        {{--            // SHOW HOTSPOT BULLETS--}}
        {{--            $(".tab" + sequence).show();--}}

        {{--            // SELECT HOTSPOT ICON--}}
        {{--            var hotspot = document.getElementsByClassName('tab' + sequence);--}}

        {{--            // SELECT FLOORPLAN IMAGE--}}
        {{--            var floor_tab = document.getElementById('floorplan_tab' + sequence);--}}

        {{--            // GET FLOORPLAN IMAGES DETAILS FROM CONTROLLER--}}

        {{--            //TODO: optimize code toreduce number of loops--}}
        {{--            const property_hotspot_details = {!! $property_floorplan_images !!};--}}
        {{--            property_hotspot_details.forEach(floorplanImagesData);--}}

        {{--            function floorplanImagesData(response) {--}}
        {{--                for (let i = 0; i < hotspot.length; i++) {--}}
        {{--                    // console.log(hotspot[i].classList[2] + " :: " + response.id);--}}
        {{--                    if (hotspot[i].classList[2] == response.id) {--}}
        {{--                        // Get stored floorplan hotspot ratio in percentage--}}
        {{--                        //0 = height, 1 = width--}}
        {{--                        var backend_image_ratio = (response.floorplan_image_ratio.split(","));--}}

        {{--                        //0= width, x, 1 = height - y--}}
        {{--                        var backend_hotspot_cordinates = (response.coordinates.split(","));--}}

        {{--                        var backend_margin_top_hotspot_percentage = backend_hotspot_cordinates[1] / backend_image_ratio[0];--}}
        {{--                        var backend_margin_left_hotspot_percentage = backend_hotspot_cordinates[0] / backend_image_ratio[1];--}}

        {{--                        // console.log(backend_margin_top_hotspot_percentage + " :: " + backend_margin_left_hotspot_percentage);--}}
        {{--                        // console.log(floor_tab.offsetWidth + " :: " + floor_tab.offsetHeight);--}}

        {{--                        // set margin from  top and left in hotspot in floorplan page--}}
        {{--                        // And subtract 25 from final margin top and left same as agent section--}}
        {{--                        hotspot[i].style.marginLeft = ((backend_margin_left_hotspot_percentage * floor_tab.offsetWidth) - 25).toString() + 'px';--}}
        {{--                        hotspot[i].style.marginTop = ((backend_margin_top_hotspot_percentage * floor_tab.offsetHeight) - 25).toString() + 'px';--}}

        {{--                    }--}}
        {{--                }--}}
        {{--            }--}}
        {{--        }--}}
        {{--        @endif--}}
    </script>
@endpush
@section('content')
    @livewire('property-view', ['unique_url' => $unique_url])
@stop
