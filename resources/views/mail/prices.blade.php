<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    <style>

            body{
              background: #edf2f4;
              perspective: 1000px;
              transform-style: preserve-3d;
              display: flex;
              height: 100vh;
              font-family: "Playfair Display",georgia,serif;
            }
            .card{
              pointer-events: none;
              transform: translateZ(0);
              padding: 30px;
              background: white;
              border-radius: 5px;
              width: 400px;
              height: 200px;
              margin: auto;
              transform-style: preserve-3d;
              backface-visibility: hidden;
              display: flex;
              box-shadow: 0 0 5px rgba(0,0,0,.1);
              position: relative;
              
              &:after{
                content:" ";
                position: absolute;
                width: 100%;
                height: 10px;
                border-radius: 50%;
                left:0;
                bottom:-50px;
                box-shadow: 0 30px 20px rgba(0,0,0,.3);
                
              }
              
              .card-content{
                margin: auto;
                text-align:center;
                transform-style: preserve-3d;
              }
              
              h1{
                transform: translateZ(100px);
              }
              p{
                transform: translateZ(50px);
                display: block;
                
                &.related{
                  transform: translateZ(80px);
                  font-style: italic;
                }
              }
              a{
                color:#69c6b8;
                pointer-events: auto;
              }
            }
            
            .iklan{
              position: fixed;
              bottom: 0;
              right: 0;
              background: white;
              width: 200px;
              padding: 20px;
              font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
              
              p{
                margin: 0 0 15px;
                line-height: 1.4;
              }
              
              a{
                background-color: #ff4757;
                color: white;
                display: inline-block;
                padding: 10px 20px;
                border-radius: 3px;
                text-decoration: none;
                font-size: 14px;
              }
            }
        </style>
        <div class="card">
          <div class="card-content">
            <h1>Mobil</h1>
            <p><small><a  target="_blank">Precios para el día de mañana, esto es una prueba.</a></small></p>
            <p class="related"><strong>See also: </strong><a target="_blank">Extra: {{$extra}}</a></p><br>
            <p class="related"><strong>See also: </strong><a target="_blank">Extra: {{$supreme}}</a></p>
            <p class="related"><strong>See also: </strong><a target="_blank">Extra: {{$diesel}}</a></p>
          </div>
        </div>
        
       
    </body>
</html>