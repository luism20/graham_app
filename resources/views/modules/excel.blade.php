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
                    <script>
                      function handleFiles(files) {
                        if(files.length>0) {
                          document.getElementById("file-name").innerText = files[0].name;
                        }                        
                      }
                    </script>

                    <div class="tile is-parent">
                               <article class="tile is-child notification onboarding_integration">
                               
                    <form id="form" role="form" method="post" action="excel/import" enctype="multipart/form-data">
                      <div class="file has-name is-fullwidth">
                        <label class="file-label">
                          <input id="file_input" name="file_input" class="file-input" type="file" onchange="handleFiles(this.files)">
                          <span class="file-cta">
                            <span class="file-icon">
                              <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                              Choose a file…
                            </span>
                          </span>
                          <span id="file-name" class="file-name">
                          </span>
                        </label>
                    </div>
                    <progress class="progress is-success" value="0" max="100" style="margin-top:20px;display:none;">60%</progress>
                    <div class="box-footer" style="margin-top:20px;">
                            @csrf
                            <input type="submit" class="button is-success" value="Submit" />
                        </div>                      
                    </form>
                 
                    <script>
                      $(function() {
                          var bar = $('#bar');
                          var percent = $('#percent');
                          var status = $('#status');

                          $('form').ajaxForm({
                              beforeSend: function() {
                                  status.empty();
                                  document.getElementById("progressBar").style.display = "block";
                                  var percentVal = '0';
                                  bar.html(percentVal);
                                  percent.css("value", percentVal);
                              },
                              uploadProgress: function(event, position, total, percentComplete) {
                                  var percentVal = percentComplete ;
                                  bar.html(percentVal);
                                  percent.css("value", percentVal);
                              },
                              complete: function(xhr) {
                                  var errors = JSON.parse(xhr.responseText);                
                                  status.html(errors.message);
                                  $('#file_input').val('');
                              }
                          });
                      });
                    </script>
                    
                    </article>
                            </div>

                </div>
            </div>
        </section>
    </body>
</html>

