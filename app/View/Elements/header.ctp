<style media="screen">
  .form-control{
                width:500px;
               }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://localhost:8888/shopping/">Ryo's Weapon Shoooooooop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="http://localhost:8888/shopping/#">Home <span class="sr-only">(current)</span></a>
      </li> -->
      <li class="nav-item dropdown active">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         User
       </a>
       
         
       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="#">Purchase history</a>
         <a class="dropdown-item" href="#">My Account</a>
         <div class="dropdown-divider"></div>
         
         <a class="dropdown-item" href="http://localhost:8888/shopping/logout">Logout</a>
       </div>
       
      
     </li>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Cart <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost:8888/shopping/login">Login <span class="sr-only">(current)</span></a>
      </li>
      
      <!-- session display -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <?php 
          // var_dump($current_user);
           if(isset($current_user['username']))
           {
             echo 'Welcom :'. ' '.$current_user['username'];
           }
          ?>
          <span class="sr-only">(current)</span>
        </a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    
  </div>
</nav>