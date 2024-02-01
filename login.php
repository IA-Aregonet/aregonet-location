<?php
/* 渭logger
 *
 * Copyright(C) 2017 Bartek Fabiszewski (www.fabiszewski.net)
 *
 * This is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <http://www.gnu.org/licenses/>.
 */

  require_once("helpers/auth.php");
  require_once(ROOT_DIR . "/helpers/lang.php");
  require_once(ROOT_DIR . "/helpers/config.php");

  $auth_error = uUtils::getBool('auth_error', false);

  $config = uConfig::getInstance();
  $lang = (new uLang($config))->getStrings();

?>
<!DOCTYPE html>
<html lang="<?= $config->lang ?>">
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Free Bulma template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title><?= $lang["title"] ?></title>
    <?php include("meta.php"); ?>
    <script type="text/javascript">
      function init() {
        const form = document.forms[0];
        const action = form.getAttribute('action');
        form.setAttribute('action', action + window.location.hash);
        const cancelEl = document.getElementById('cancel');
        if (cancelEl) {
          cancelEl.firstElementChild.href += window.location.hash;
        }
        form.elements[0].focus();
      }
    </script>
  </head>
  
  <body>

    <section class="hero is-success is-fullheight">
	<div style="background-image: url('2609.jpg'); ">
        <div class="hero-body">
		
            <div class="container has-text-centered">
			
                <div class="column is-4 is-offset-4">
				
                    <h3 class="title has-text-white">Login</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-white">Please login to proceed.</p>
					
                    <div class="box">
                        <figure class="avatar">
                            <img src="aregonet.png">
                        </figure>
                        
                              <form action="<?= BASE_URL ?>" method="post">
        
        <input class="input is-large" input id="login-user" type="text" name="user" placeholder="Your User" autofocus="" required><br>
        <br>
        <input class="input is-large" input id="login-pass" type="password" name="pass" placeholder="Your Password" required><br>
        <br>
        <button input type="submit" button class="button is-block is-info is-large is-fullwidth">Login <i class="fa fa-sign-in" aria-hidden="true"></i> </button>
        <input type="hidden" name="action" value="auth">
        <?php if (!$config->requireAuthentication): ?>
          <div id="cancel"><a href="<?= BASE_URL ?>"><?= $lang["cancel"] ?></a></div>
        <?php endif; ?>
      </form>
      <?php if ($auth_error): ?>
        <div id="error"><?= $lang["authfail"] ?></div>
      <?php endif; ?>
                                <label class="checkbox">
                  <input type="checkbox">
                  Remember me
                </label>
                            </div>
                           
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="../">Sign Up</a> &nbsp;路&nbsp;
                        <a href="../">Forgot Password</a> &nbsp;路&nbsp;
                        <a href="../">Need Help?</a>
                    </p>
					<br>
					<br>
                </div>
            </div>
        </div>
    </section>
	
    <script async type="text/javascript" src="../js/bulma.js"></script>
	
</body>
</html>