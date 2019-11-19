<!DOCTYPE html>
<html class="setup-body"  >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$title}}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body class="setup-body">
        <section class="section">
            <div class="container">
                <div class="onboarding_wrapper">
                    <header class="onboarding_header">
                    <h1 class="title">Cool, let's upload that accounting data!</h1>
                    <div class="subtitle" style="padding: 20px;">
                    <h2 >
                    You can get an example of the file structure we need to upload <a href="../file/template.xlsx">here</a>
                    </h2>                    
                    </div>
                    </header>

                    <div class="tile is-ancestor">
                        <div class="tile is-vertical">

                            <div class="tile is-parent">
                               <article class="tile is-child notification onboarding_integration">                                    
                                    <div class="media">
                                      <div class="onboarding_logo">
                                        <figure class="image is-48x48">
                                          <img src="{{ asset('img/qbo_logo.jpg') }}" alt="Quickbooks Online">
                                        </figure>
                                      </div>
                                      <div class="media-content">
                                        <p class="title is-4">Quickbooks Online</p>
                                      </div>
                                      <a class="onboarding_connect" href="/settings/connections/connect_stripe">Connect</a>
                                    </div>                                 
                                </article>
                            </div>

                            <div class="tile is-parent">
                               <article class="tile is-child notification onboarding_integration">                                    
                                    <div class="media">
                                      <div class="onboarding_logo">
                                        <figure class="image is-48x48">
                                          <img src="https://img.icons8.com/color/144/000000/ms-excel.png" alt="Placeholder image">
                                        </figure>
                                      </div>
                                      <div class="media-content">
                                        <p class="title is-4">Excel</p>
                                      </div>
                                      <a class="onboarding_connect" href="/settings/connections/connect_stripe">Connect</a>
                                    </div>                                 
                                </article>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

