<?PHP
require_once("Authentication.php");
$authentication = new Authentication();
if(isset($_POST['submitted']))
{
   if($authentication->Registration())
   {
        $authentication->RedirectToURL("Main.php");
   }
    else {
       echo $authentication->error_message;
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movies-eShop</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="myjs.js"></script>
    <link rel="icon" href="../my_images/favicon.ico" type="image/icon">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="flex">
        <!--Header--><!--Navigator-->
        <header>
             <?php include 'Menu.php'; ?>
        </header>
        <!--loader-->
        <div id="loader-wrapper">
          <div id="loader"></div>
       
          <div class="loader-section section-left"></div>
          <div class="loader-section section-right"></div>
       
        </div>
        <!--Loader's Header-->
        <div class="entry-header">
          <h1 class="entry-title">Movies-eShop <img class="loaderImg" src="../my_images/home.png"></h1>
        </div>
        <!--Movies Logo-->
        <div class="bigLogo">
            <a href="Main.php"><img src="../my_images/home.png" width="70%" height="70%" /></a>
        </div>

        <!--Main Body-->
        <section class="fonts">

            <!--Registration Form-->
            <div class="max-grid">
                <form id='Registration' method='post'>
                    <input type='hidden' name='submitted' id='submitted' value='1'/>              
                    <table width="30%" height="730px" bgcolor="#ff2d2d" align="center" class="mainTable" style="max-width: 500px;">
                        <tr>
                            <td align="center"><font size="6" class="textShad"><b>Sign up</b></font><br /></td>
                        </tr>
                        <tr>
                            <td>
                                <!--7x Input Fields-->
                                <table align="center" width="100%" height="100%" bgcolor="#e8e8e8" id="regTable">
                                    <tr>
                                        <td align="center">
                                            <input type="text" id="Username" name="Username" maxlength="15" autofocus required placeholder="Username">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="password" id="Password" name="Password" maxlength="15" required placeholder="Password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="text" id="Name" name="Name" maxlength="10" required placeholder="Name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="text" id="Surname" name="Surname" maxlength="10" required placeholder="Surname">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <select id="Sex" name="Sex" required form="Registration">
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                            </select>                                         
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="email" id="Email" name="Email" required placeholder="Email">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="number" id="Age" name="Age" max="100" required placeholder="Age">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="text" id="Proffesion" name="Proffesion" required placeholder="Proffesion">
                                        </td>
                                    </tr>
                                    <tr>
                                        <!--Register Button-->
                                        <td align="center">
                                            <button class="forwardButton" style="vertical-align:middle"><span>Sing up</span></button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </section>
    </div>
   
    <!--Footer-->
    <footer>
        <?php include 'Footer.php'; ?>
    </footer>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
  <script src="js/main.js"></script> 
</body>
</html>