<?php
    /* at the top of 'check.php' */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           Up to you which header to send, some prefer 404 even if 
           the files does exist for security
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* choose the appropriate page to redirect users */
        die( header( 'location: /error.php' ) );

    }
?>

<header id="navbar">
    <nav id="navbar_wrapper">
        <ul>
            <li>
                <div id="home_button_wrapper">
                    <figure id="home_button">
                        <a href="http://localhost/nfe114/index.php"><img src="http://localhost/nfe114/images/home.png" alt="home" class="homeImage"/></a>
                    </figure>
                </div>
            </li>
            <li>
                <div id="connexion_wrapper">
                    <figure id="avatar">
                        <img src="http://localhost/nfe114/images/noavatar.png" class="avatarImage"/>  
                        <img src="http://localhost/nfe114/images/arrowDown.png" class="arrow"/>
                    </figure>
                    <div id="connexion">
                        <div id="authentificationForm_wrapper">    
                            <form action="php/authentification.php" method="post" id="authentificationForm">
                                <label>email: </label><input type="text" name="login" placeholder="email" id="log"/><br/>
                                <span class="error"></span><br/>
                                <label>password: </label><input type="password" name="pass" placeholder="password" id="pass"/><br/>
                                <span class="error"></span><br/>
                                <input type="submit" name="submit" id="submit" value="Connexion"/>
                            </form> 
                            <button id="createButton">Créer Compte</button>
                        </div>
                        <div id="registerForm_wrapper">
                            <form action="php/authentification.php" method="post" id="registerForm">
                                <label>Votre Nom: </label><input type="text" name="surname" placeholder="nom"/><br/>
                                <span class="error"></span><br/>
                                <label>Votre prénom: </label><input type="text" name="firstname" placeholder="prenom"/><br/>
                                <span class="error"></span><br/>
                                <label>Votre Email: </label><input type="text" name="mail" placeholder="Email"/><br/>
                                <span class="error"></span><br/>
                                <label>Mot de Passe: </label><input type="password" name="pass1" placeholder="Mot de Passe"/><br/>
                                <span class="error"></span><br/>
                                <label>Répéter Mot de Passe: </label><input type="password" name="pass2" placeholder="Mot de Passe"/><br/>
                                <span class="error"></span><br/>
                                <input type="submit" value="Envoyer"/>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <figure id="search_icon">
                    <img src="http://localhost/nfe114/images/search.png" />
                </figure>
                <form id="search_wrapper" method="post" action="http://localhost/nfe114/public/controller.php">
                    <input type="text" id="searchBox" name="searchBoxContent" /><br/>
                    <p><input type="radio" value="spectacle" name="searchCritera" checked="checked"/><label>Par Spectacle</label>
                    <input type="radio" value="artiste" name="searchCritera" /><label>Par Artiste</label></p>
                    <p><input type="radio" value="genre" name="searchCritera" /><label>Par Genre</label>
                    <input type="radio" value="ville" name="searchCritera" /><label>Par Ville</label></p>
                    <p><input type="radio" value="prix" name="searchCritera" /><label>Par Prix</label>
                    <input type="submit" value="Lancer" id="submitSearch"/></p>
                </form>
            </li>
        </ul>
    </nav>
</header>
