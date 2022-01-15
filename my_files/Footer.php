<div class="footer">
    <table>
        <tr>
            <td class="line">
                <div>
                    <span><div>Movies</div></span><br />
                    <span>We provide with the latest and greatest movies of all time.<br /><br />Our list is constantly updated with the latest products.</span>
                </div>
            </td>
            <td class="line">
                <div>
                    <span><div>Community</div></span><br />
                    <span>Community helps us deliver more accurate results.It's also very friendly.Every member treats each other with mutual respect. <br /><br />

                    <?PHP 
                    require_once("Authentication.php");
                    $authentication = new Authentication();

                    if(!$authentication->CheckLogin())                       
                        echo "Help the community grow by <a href='Registration.php'>Signing up!</a>";
                    ?>
                    </span>
                </div>
            </td>
            <td class="line">
                <div>
                    <span><div>Purpose</div></span><br />
                    <span>We deliver the best possible sum-up for every movie, so clients are aware of our products.<br /><br />This is based on your opinion, so rate and review honestly.Buy and enjoy!</span>
                </div>
            </td>
            <td>
                <div class="follow">
                    <div>Follow Us</div>
                    <a href="Maintenance.php"><img src="../my_images/facebook.png"/></a>
                    <a href="Maintenance.php"><img src="../my_images/twitter.png"/></a>
                    <a href="Maintenance.php"><img src="../my_images/google.png"/></a>         
                    <a href="Maintenance.php"><img src="../my_images/pinterest.png"/></a>
                </div>
            </td>
        </tr>    
    </table>

    <p>
        <font color="#d32626">
            Use <a href="https://www.google.com/chrome/"><img src="../my_images/chrome.png"/ style="width: 20px;"></a> for tested optimal experience
        </font>
    </p></br>

    <p>
        <font color="#d32626">
            Copyright &copy; 2018 Movies-eShop.com
        </font>
        
    </p>
    <p>
        <font color="#d32626">
            Developed by Panagiotis Stathopoulos
        </font>
        <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
        <script type="IN/MemberProfile" data-id="https://www.linkedin.com/in/panagiotis-stathopoulos-27b605137" data-format="hover" data-related="false"></script>
        
    </p>
</div>

