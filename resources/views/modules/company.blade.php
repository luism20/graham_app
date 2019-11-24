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
            <div class="container" style="min-width: 450px">
                <div class="onboarding_wrapper">
                    <header class="onboarding_header ">
                    <h1 class="title">Welcome, let's get you set up!</h1>
                    <div class="onboarding_subtitle" style="padding: 20px;">
                    <p>
                    First of all, tell us a bit about your company.
                    </p>
                    </div>

                    </header>

                    <div class="tile is-ancestor">
                      <div class="tile is-vertical">
                        <article class="tile is-child notification onboarding_integration">
                        <form id="form" role="form" method="post" action="addCompany" enctype="multipart/form-data">
                        <div class="field">
                          <label class="label" for="name">Company Name</label>
                          <div class="control">
                            <input class="input" type="text" id="name" name="name" placeholder="Company Name">
                          </div>                          
                        </div>
                        @csrf
                        <div class="buttons has-addons is-right">                      
                            <button class="button is-link">Next</button>                                                 
                        </div>
                        </form>  
                         </article> 
                      </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

