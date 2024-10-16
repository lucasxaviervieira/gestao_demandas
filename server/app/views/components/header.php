<header class="header">
    <div class="left">
        <div class="header-logo">
            <a href="/home" class='logo'>
                <img src="/assets/logo.png" alt="Logo">
                <h2>Águas de Joinville</h2>
            </a>
        </div>
    </div>
    <div class="center">
        <div class="header-title">
            <a href="/home">
                <h2>
                    Controle de Demandas
                </h2>
            </a>
            <div class='sub-title'>
                <span>última atualização:</span>
                <?php
                $lastTime = $data['last_update']['time'];
                $lastDate = $data['last_update']['date'];
                $dateTime = "horário:<strong>$lastTime</strong> data: <strong>$lastDate</strong>";
                echo $dateTime;
                ?>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="header-dropdown">
            <button class="dropbtn">
                <i class="fa-regular fa-user"></i>
            </button>
            <div class="dropdown-content">
                <span>
                    <i class="fas fa-user user-icon"></i>
                    <?php echo $data['username']; ?>
                </span>
                <form action="exit" method="POST">
                    <button id="submit-exit" type='submit'>
                        <span>
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Sair
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>