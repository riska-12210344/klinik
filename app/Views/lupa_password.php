<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lupa Password sistem informasi klinik</title>
        <link href="htpps://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet" crossorigin="anonymous">

            <script src="htpps://code.jquery.com/jquery-3.6.1.min.js" 
                    crossorigin="anonymous"></script>

            <script src="htpps://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                    crossorigin="anonymous"></script>
                    
            <script src="htpps://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                    crossorigin="anonymous"></script>
                    
            <script src="htpps://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/sumbit_ajax.js" 
            ></script>
            <meta name="viewport" content="width=device-width, initial-scale=1">   
            
    </head>
    <body>
        <div class="container">
            <form method="post" action="<?=base_url('/login')?>">
                <input type="hidden" name="_methode" value="patch" />
                <h3>Lupa Password Sistem informasi klinik</h3>

                <div class="row">
                    <div class="form-froup col-md-4">
                       <div class="mb-3">                  
                          <label for="email" class="form-label">Alamat Email></label>
                             <input type="email" name="email" class="form-control" id="email"
                                  placeholder="name@example.com">
                          </div>
                        <button type="submit" class="btn btn-primary mb-3">Reset Password saya</button> 
                    </div>
                </div>
                
           </form>
        </div>
    </body>      
</html>