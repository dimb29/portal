
<title>Register</title>

<x-guest-layout>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Contact Form Template</title>
        <link rel="stylesheet" href="/build/tailwind.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        
        <style>
            
            .headerm {
            position:relative;
            text-align:center;
            background: linear-gradient(60deg, rgb(177 159 243) 0%, rgba(0,172,193,1) 100%);
            color:white;
            }
            .inner-header {
            height:12vh;
            width:100%;
            margin: 0;
            padding: 0;
            }

            .flex1 { /*Flexbox for containers*/
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            }

            .waves {
            position:relative;
            width: 100%;
            height:15vh;
            margin-bottom:-7px; /*Fix for safari gap*/
            min-height:100px;
            max-height:150px;
            }

            /* Animation */

            .parallax > use {
            animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
            }
            .parallax > use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
            }
            .parallax > use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
            }
            .parallax > use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
            }
            .parallax > use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
            }
            @keyframes move-forever {
            0% {
            transform: translate3d(-90px,0,0);
            }
            100% { 
                transform: translate3d(85px,0,0);
            }
            }
            /*Shrinking for mobile*/
            @media (max-width: 768px) {
            .waves {
                height:40px;
                min-height:40px;
            }

            }
        </style>
    </head>
    <body class>
        <div class="lg:flex">
            <div class="lg:w-1/2 xl:max-w-screen-sm">
                <!--Hey! This is the original version
                of Simple CSS Waves-->

                <div class="headerm">

                <!--Content before waves-->
                <div class="inner-header flex1">
                <div style="cursor: pointer;" onclick="window.location='{{ url('') }}';" class="cursor-pointer flex items-center">
                        <div>
                            <img src="{{url('storage/photos/plogo.png')}}" alt="" class="w-14 h-14">
                        </div>
                        <div class="text-2xl sm:text-4xl text-whtie tracking-wide ml-2 font-semibold">Nama</div>
                    </div>
                </div>

                <!--Waves Container-->
                <div>
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
                </svg>
                </div>
                <!--Waves end-->

                </div>
                <!--Header ends-->

                <!--Content starts-->
                <!--Content ends-->
                    
                <div class="mt-10 px-12 sm:px-24 md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
                    <h2 class="text-center text-4xl text-indigo-900 font-display font-semibold lg:text-left xl:text-5xl
                    xl:text-bold">Register</h2>
                    <div class="mt-12">
                        
                     <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                            <div>
                                <x-jet-label for="name" value="{{ __('Name') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                <x-jet-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Liam Hemsworth"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="email" value="{{ __('Email') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="email" type="email" name="email" :value="old('email')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="liam.h@gmail.com"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="password" value="{{ __('Password') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="password" type="password" name="password" required autocomplete="new-password" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Enter your password"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Confirm your password"/>
                            </div>
                            <!-- <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="kode_referal" value="{{ __('Kode Referral ( Optional )') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="kode_referal" type="text" name="kode_referal" :value="old('kode_referal')" autocomplete="kode_referal" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="5df1#Y"/>
                            </div> -->
                            <div class="mt-10">
                                <x-jet-button class="bg-indigo-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                                shadow-lg justify-center">
                                {{ __('Register') }}
                                </x-jet-button>
                            </div>
                        </form>
                        <div class="mt-12 text-sm font-display font-semibold text-gray-700 text-center mb-8">
                            Already registered ? <a href="{{ url('/login') }}" class="cursor-pointer text-indigo-600 hover:text-indigo-800">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex items-center justify-center bg-indigo-100 flex-1 h-fit">
                <div class="w-5/6 transform duration-200 hover:scale-110 cursor-pointer">
                    <svg class="w-full mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="511.56264" height="532.44842" viewBox="0 0 511.56264 532.44842">
                        <title>Register</title>
                        <polygon points="454.49103 405.20843 454.48102 405.44842 466.49103 532.44842 378.85101 532.44842 367.49103 454.44842 362.49103 530.44842 272.49103 529.44842 282.05103 429.66839 290.18103 383.41839 290.18103 383.40838 291.401 376.44842 452.10101 376.44842 452.31103 378.96838 454.49103 405.20843" fill="#2f2e41"/>
                        <path d="M222.88285,478.83064c9.28179,1.69101,18.96019-8.76188,21.61758-23.34779,1.16327-6.38475,.78778-12.50277-.78019-17.50611l1.42323-8.40799,23.88334-113.10923s43.98031-87.97522,43.9791-103.24828c-.00111-15.27287-12.72223-22.76282-12.72223-22.76282l-17.21435,.16096-53.98264,131.84662-9.72217,97.42982-1.57289,13.36711c-3.2316,4.12897-5.74053,9.72145-6.90332,16.10621-2.65749,14.58572,2.71275,27.78048,11.99454,29.4715Z" fill="#ffb6b6"/>
                        <polygon points="397.99103 135.94842 381.99103 98.94842 329.99103 107.94842 326.49103 151.47992 397.99103 135.94842" fill="#ffb6b6"/>
                        <polygon points="397.99103 135.94842 381.99103 98.94842 329.99103 107.94842 326.49103 151.47992 397.99103 135.94842" opacity=".1"/>
                        <path d="M510.99121,212.9484s-37-69-44-76c-3.11621-3.11621-8.01465-3.15955-12.49316-2.25134l-51.50684-17.74866-17.45801-9.8092-1.15039,18.66199-57.31543,10.28748c.31836-11.38086,1.92383-15.70972,1.92383-15.70972l-21,24.56946-41,20,.02246,.18005c-3.00879,1.05029-5.86133,2.84741-8.02246,5.81995-8,11-30,145-30,145l47,10,6.39648-40.13953,4.60352,36.13953,3.5,67.5s64,55,95,35,69-19,69-19l.94824-31.28796c.6748-1.07861,1.05176-1.71204,1.05176-1.71204l-1-110.98425v-29.5321c7.61816,10.61353,16.81152,19.74109,27.5,24.01636,35,14,28-43,28-43Z" fill="#e6e6e6"/>
                        <circle cx="350.55585" cy="66.61991" r="47.83848" fill="#ffb6b6"/>
                        <path d="M384.87476,80.13948s4.15987-14.55954,13.51957-13.51957c9.3597,1.03997,11.43964-7.27977,9.3597-11.43964-2.07993-4.15987-6.2398-24.95921-6.2398-24.95921,0,0,2.07993-14.55954-10.39967-16.63947-12.4796-2.07993-16.63947-4.15987-18.71941-8.31974-2.07993-4.15987-33.27894-8.31974-43.67861-2.07993-10.39967,6.2398-18.71941,18.2117-25.99917,21.58546-7.27977,3.37375-13.51957,9.61355-9.3597,20.01322,4.15987,10.39967,10.19286,30.7392,10.19286,30.7392,0,0,10.60648-3.70006,12.68641,2.53974,2.07993,6.2398-6.2398-2.07993,4.15987-18.71941,10.39967-16.63947,10.39967-33.27894,27.03914-27.03914,16.63947,6.2398,35.35888,4.15987,33.27894,16.63947-2.07993,12.4796,4.15987,31.19901,4.15987,31.19901Z" fill="#2f2e41"/>
                        <g>
                            <path d="M381.94946,459.38422H18.63322c-10.27456,0-18.63322-8.35942-18.63322-18.63322V247.758c0-10.2738,8.35866-18.63322,18.63322-18.63322H381.94946c10.27456,0,18.63322,8.35942,18.63322,18.63322v192.993c0,10.2738-8.35866,18.63322-18.63322,18.63322Z" fill="#fff"/>
                            <path d="M381.94946,459.38422H18.63322c-10.27456,0-18.63322-8.35942-18.63322-18.63322V247.758c0-10.2738,8.35866-18.63322,18.63322-18.63322H381.94946c10.27456,0,18.63322,8.35942,18.63322,18.63322v192.993c0,10.2738-8.35866,18.63322-18.63322,18.63322ZM18.63322,232.23639c-8.55846,0-15.52161,6.96315-15.52161,15.52161v192.993c0,8.55846,6.96315,15.52161,15.52161,15.52161H381.94946c8.55846,0,15.52161-6.96315,15.52161-15.52161V247.758c0-8.55846-6.96315-15.52161-15.52161-15.52161H18.63322Z" fill="#3f3d56"/>
                            <circle cx="353.90847" cy="247.79446" r="4.66742" fill="#3f3d56"/>
                            <circle cx="366.35492" cy="247.79446" r="4.66742" fill="#3f3d56"/>
                            <circle cx="378.80138" cy="247.79446" r="4.66742" fill="#3f3d56"/>
                            <path d="M26.44872,323.2511c-1.28688,0-2.33371,1.04683-2.33371,2.33371,0,.62749,.24234,1.20788,.68218,1.63633,.44365,.45428,1.0248,.69738,1.65153,.69738H375.68976c1.28688,0,2.33371-1.04683,2.33371-2.33371,0-.62749-.24234-1.20788-.68218-1.63633-.44365-.45428-1.0248-.69738-1.65153-.69738H26.44872Z" fill="#e6e6e6"/>
                            <path d="M332.12717,322.4732v6.22323H26.44872c-.85567,0-1.63358-.34233-2.19365-.91797-.57574-.56007-.91797-1.33797-.91797-2.19365,0-1.71144,1.40026-3.11161,3.11161-3.11161H332.12717Z" fill="#6c63ff"/>
                            <path d="M371.80025,310.80464h-31.11614c-3.43144,0-6.22323-2.79103-6.22323-6.22323s2.79179-6.22323,6.22323-6.22323h31.11614c3.43144,0,6.22323,2.79103,6.22323,6.22323s-2.79179,6.22323-6.22323,6.22323Z" fill="#e6e6e6"/>
                            <path d="M167.98953,278.1327H28.78243c-3.43144,0-6.22323-2.79103-6.22323-6.22323s2.79179-6.22323,6.22323-6.22323H167.98953c3.43144,0,6.22323,2.79103,6.22323,6.22323s-2.79179,6.22323-6.22323,6.22323Z" fill="#e6e6e6"/>
                            <path d="M26.44872,393.26242c-1.28688,0-2.33371,1.04683-2.33371,2.33371,0,.62749,.24234,1.20788,.68218,1.63633,.44365,.45428,1.0248,.69738,1.65153,.69738H375.68976c1.28688,0,2.33371-1.04683,2.33371-2.33371,0-.62749-.24234-1.20788-.68218-1.63633-.44365-.45428-1.0248-.69738-1.65153-.69738H26.44872Z" fill="#e6e6e6"/>
                            <path d="M212.33003,392.48451v6.22323H26.44872c-.85567,0-1.63358-.34233-2.19365-.91797-.57574-.56007-.91797-1.33797-.91797-2.19365,0-1.71144,1.40026-3.11161,3.11161-3.11161H212.33003Z" fill="#6c63ff"/>
                            <path d="M371.80025,380.81596h-31.11614c-3.43144,0-6.22323-2.79103-6.22323-6.22323s2.79179-6.22323,6.22323-6.22323h31.11614c3.43144,0,6.22323,2.79103,6.22323,6.22323s-2.79179,6.22323-6.22323,6.22323Z" fill="#e6e6e6"/>
                        </g>
                        <g>
                            <ellipse cx="426.27357" cy="70.44086" rx="48.72643" ry="47.69976" fill="#6c63ff"/>
                            <path d="M442.81136,46.3808c-6.487,11.81215-12.97405,23.62439-19.46106,35.43659-4.13442-7.30499-8.24624-14.62285-12.39083-21.92211-1.43136-2.5209-5.32473-.25351-3.88976,2.27368,4.80448,8.46149,9.55919,16.95111,14.36367,25.41259,.82147,1.44676,3.07677,1.48035,3.8898,0,7.12599-12.9757,14.25199-25.95141,21.37798-38.92707,1.39635-2.54258-2.4924-4.81822-3.8898-2.27368Z" fill="#fff"/>
                        </g>
                        <path d="M493.53827,196.17181l-48.54724-23.22339s-1.94983-15.5437-11.05402-21.08789c-1.54779-3.6925-3.32855-7.74908-4.94598-10.96332-4-7.94879,2-22.94879-3-22.94879s-12.39122,15.77543-12,20c.30031,3.24292,2.98059,8.90472,3.5343,13.8609-6.09709,2.29949-11.01564,6.24084-14.24964,9.37903-2.79865,2.71575-3.8385,6.76755-2.74475,10.51073,3.16948,10.84703,11.09153,33.24933,22.46008,33.24933,15,0,19-3,19-3,0,0,31,39,54,42s-2.45276-47.77661-2.45276-47.77661Z" fill="#ffb6b6"/>
                    </svg>
                </div>
            </div>
        </div>
    </body>
</html>
</x-guest-layout>
