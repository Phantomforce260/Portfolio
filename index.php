<!DOCTYPE html>
<html>
    <head>
        <?php
            // Get URL parameters
            $show = isset($_GET['show']) && $_GET['show'] === 'true';
            require('server.php');
        ?>

        <base href="/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Portfolio - Adrian Cervera</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="assets/boxicons/css/boxicons.min.css">
        <link rel="stylesheet" href="assets/devicon/devicon.min.css">
    </head>

    <body>
        <div class="adri-background">
            <header>
                <!--<a href=""><img src="<?=IMAGE_ROOT?>/Lunarflame_Logo.png"></a>-->
                <nav class="nav-links">
                    <i class="bx bx-x" onclick="hideMenu()"></i>
                    <ul>
                        <li><a class="hover" id="light-blue" href="https://lunarflame.dev">LunarFlame Studios Website</a></li>
                    </ul>
                </nav>
                <i class="bx bx-menu" onclick="showMenu()"></i>
            </header>
            
            <section class="page-body">
                <?= OVERLAY; ?>

                <div class="adri-title">
                    <?php
                        typewriteGradient(1, "Adrian Cervera");
                        echo Text::multiTypewrite(H4, "Lead Programmer", "Lead Artist", "Co-Founder", "Web Developer", "Game Designer");
                    ?>
                </div>

                <main>
                    <div>
                        <span id="profile-pic">
                            <img id="adri-pfp" src="<?=IMAGE_ROOT?>/adri_pfp.jpg" alt="">
                        </span>
                        <div>
                            <?php typewrite("Hi! I'm a computer Science Major at WPI. I like playing video games and making video games!"); ?>
                            <div class="reverse social-links">
                                <?php
                                    Adrian::social("github", "https://github.com/phantomforce260", "github");
                                    Adrian::social("discord", "https://discord.gg/khKCJyjKSm", "discord-alt");
                                    Adrian::social("instagram", "https://www.instagram.com/phantomforce26/", "instagram");
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php Adrian::resume($show); ?>
                </main>

                <div class="adri-skills">
                    <?php
                        typewriteGradient(5, "Tools and Languages");
                        iconRow(
                            "java-plain-wordmark",
                            "c-plain",
                            "cplusplus-plain",
                            "csharp-plain",
                            "python-plain-wordmark",
                            "html5-plain-wordmark",
                            "css3-plain-wordmark"
                        );

                        iconRow(
                            "javascript-plain",
                            "typescript-plain",
                            "php-plain",
                            "svelte-plain",
                            "react-original",
                            "git-plain-wordmark"
                        );

                        iconRow(
                            "github-original",
                            "unity-plain",
                            "vscode-plain",
                            "visualstudio-plain",
                            "neovim-plain-wordmark",
                            "photoshop-plain",
                            "illustrator-plain"
                        );

                        iconRow(
                            "premierepro-plain",
                            "aftereffects-plain",
                            "bun-plain",
                            "nginx-original",
                            "debian-plain-wordmark",
                            "ubuntu-plain-wordmark",
                        );
                    ?>
                    <hr>
                </div>

                <div class="adri-projects">
                    <?php typewriteGradient(5, "My Role and Projects"); ?>
                    <div class="project-leo">
                        <?php echo Text::typewriteGradient(1, H2, "Project Leo"); ?>
                        <div class="artwork">
                            <?php
                                ProjectLeo::loadWorlds();
                                ProjectLeo::loadChars();
                                ProjectLeo::loadMisc();
                                ProjectLeo::loadDev($show);
                            ?>
                        </div>
                        <hr>
                        <div class="code">
                            <h3 style="color: #C8E9EF;">Code</h3>
                            <div>
                                <?php
                                    ProjectLeo::codeContent(
                                        "#B4A0C8",
                                        "Core Gameplay Mechanics",
                                        "Implemented the core gameplay mechanics of Project Leo, including player movement, obstacle generation, and level progression. Utilized Unity's physics engine to create a responsive and engaging gameplay experience.",
                                        IMAGE_ROOT . "/PL_SS_1.png",
                                        false
                                    );

                                    ProjectLeo::codeContent(
                                        "#A9DAE4",
                                        "Shop, Currency, and Inventory",
                                        "Developed the shop system, allowing players to purchase upgrades and items using in-game currency. Implemented an inventory system to manage player items and upgrades.",
                                        IMAGE_ROOT . "/PL_SS_2.png",
                                        true
                                    );

                                    ProjectLeo::codeContent(
                                        "#B193C4",
                                        "Level Design and World Building",
                                        "Designed and implemented the mission system, providing players with objectives to complete for rewards. Integrated mission tracking and completion feedback into the user interface.",
                                        IMAGE_ROOT . "/PL_SS_3.png",
                                        false
                                    );

                                    ProjectLeo::codeContent(
                                        "#CDCDE0",
                                        "Cloud and Local Saves",
                                        "Implemented cloud saving functionality to ensure player progress is saved across sessions. Developed local save systems for offline play, allowing players to continue their progress without an internet connection.",
                                        IMAGE_ROOT . "/PL_SS_4.png",
                                        true
                                    );
                                ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <?php
                        echo Text::typewriteGradient(1, H2, "Website");
                        Website::codeContent();
                    ?>
                </div>
            </section>
        </div>

        <section class="copyright">
            <nav>
                <div class="social-links">
                    <ul>
                        <li>
                            <a class="icon github" href="https://github.com/Lunarflame-Studios" target="_blank">
                                <i class="bx bxl-github"></i>
                            </a>
                        </li>

                        <li>
                            <a class="icon instagram" href="https://www.instagram.com/phantomforce26/" target="_blank">
                                <i class="bx bxl-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <h1 onclick="changeCursorColor()">Copyright © 2024 LunarFlame Studios</h1>
            </nav>
        </section>

        <span class="panner" data-cursor="stretch"></span>
        <span class="pointer"></span>

        <div class="js-links">
            <script src="<?=I_JS?>/tweenmax.min.js"></script>

            <script src="<?=JS?>/typewrite.js"></script>
            <script src="<?=JS?>/images.js"></script>
            <script src="<?=JS?>/cursor.js"></script>
        </div>
        <script>
            var navLinks = document.querySelector("header .nav-links");
            var socialLinks = document.querySelector(".social-links");

            function showMenu() {
                navLinks.style.right = "0";
                socialLinks.style.right = "0";
            }

            function hideMenu() {
                navLinks.style.right = "-50vw";
                socialLinks.style.right = "-50vw";
            }
        </script>
    </body>
</html>
