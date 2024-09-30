<header class="header">
    <ul>
        <li>
            <a href="/home" class='logo'>
                <img src="/assets/logo.png" alt="Logo">
                <h2>CAJ</h2>
            </a>
        </li>
        <li class="header-title">
            <a href="/home">
                <h2>
                    Controle de Demandas
                </h2>
            </a>
            <div class='sub-title'>
                <span>última atualização: </span>
                <?php echo $data['last_update']; ?>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="dropbtn">usuário</button>
                <div class="dropdown-content">
                    <span>
                        <?php echo $data['username'];
                        ?>
                    </span>
                    <form action="exit" method="POST">
                        <button id="submit-exit" type='submit'>
                            <span>
                                sair
                            </span>
                        </button>
                    </form>

                </div>
            </div>

        </li>
    </ul>
</header>