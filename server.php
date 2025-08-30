<?php 
    define('OVERLAY', <<<HTML
        <span id="overlay"></span>
        <img id="zoom-in" src="" alt="">
    HTML);

    define('EMPTY_CHAR', '&#8203;');
    define('EMPTY_STRING', '');

    define('IMAGE_ROOT', 'assets/images');
    define('JS', 'assets/js');
    define('I_JS', 'assets/importedJS');

    define('H1', 'h1');
    define('H2', 'h2');
    define('H3', 'h3');
    define('H4', 'h4');
    define('P', 'p');

    define('PINK', 'pink');
    define('BLUE', 'blue');
    define('LIGHT_BLUE', 'light-blue');
    define('PURPLE', 'purple');

    define('DEFAULT_PARAGRAPH', P);
    define('DEFAULT_HEADER', H1);

    function gradient(int $color, string $content) : void {
        echo Text::gradient($color, DEFAULT_HEADER, $content);
    }

    function typewrite(string $content) : void {
        echo Text::typewrite(DEFAULT_PARAGRAPH, $content);
    }

    function typewriteGradient(int $color, string $content) : void {
        echo Text::typewriteGradient($color, DEFAULT_HEADER, $content);
    }

    function multiTypewriteGradient(int $color, string ...$contents) : void {
        echo Text::multiTypewriteGradient($color, DEFAULT_HEADER, ...$contents);
    }

    function multiTypewrite(string ...$contents) : void {
        echo Text::multiTypewrite(DEFAULT_PARAGRAPH, ...$contents);
    }

    function borderImage(string $src, string $color = EMPTY_STRING) : void {
        echo Image::border($src, $color);
    }

    function pageImage(string $src) : void {
        echo Image::standard($src);
    }

    function carousel(string ...$images) : void {
        echo Image::carousel(...$images);
    }

    function orbs(string ...$colors) : void {
        // Start the wrapper div
        $html = EMPTY_STRING;
        $fileName = "";

        // Loop through each color argument
        foreach ($colors as $color) {
            // Skip empty strings or nulls
            if (trim($color) === '')
                continue;

            switch($color) {
                case PINK:
                    $fileName = "Pink";
                    break;
                case BLUE:
                    $fileName = "Blue";
                    break;
                case LIGHT_BLUE:
                    $fileName = "Light-Blue";
                    break;
                case PURPLE:
                    $fileName = "Purple";
                    break;
                default:
                    $fileName = "error";
                    break;
            }

            // Append the orb image tag
            $html .= '<img class="orb" id="' . htmlspecialchars($color) . '" src="' . IMAGE_ROOT . '/vfx/' . htmlspecialchars($fileName) . '-Glow.png" alt="">' . PHP_EOL;
        }

        // Close the wrapper div
        echo <<<HTML
            <div id="glow-orbs">
                $html
            </div>
        HTML;
    }

    function circuit(string $version) : void {
        echo <<<HTML
            <div>
                <span class="circuit" id="$version"></span>
            </div>
        HTML;
    }

    function devIcon($class) : string {
        $rand = rand(1, 5);
        return <<<HTML
            <span class="icon" id="v$rand">
                <i class="devicon-$class"></i>
            </span>
        HTML;
    }

    function iconRow(...$items) : void {
        $row = EMPTY_STRING;
        foreach ($items as $item) {
            $row .= devIcon($item) . PHP_EOL;
        }
        echo <<<HTML
            <div class="icon-row">
                $row
            </div>
        HTML;
    }

    class Text {

        public static function typewrite(string $textVer, string $content) : string {
            $empty = EMPTY_CHAR; 
            return <<<HTML
                <$textVer class="typewriter-v2">$empty
                    <span>$content</span>
                </$textVer>
            HTML;
        }

        public static function gradient(string $color, string $headerVer, string $content) : string {
            $color = $color == -1 ? rand(1, 5) : $color;
            return <<<HTML
                <$headerVer class="gradient" id="v{$color}">$content</$headerVer>
            HTML;
        }

        public static function typewriteGradient(string $color, string $headerVer, string $content) : string {
            $empty = EMPTY_CHAR; 
            $color = $color == -1 ? rand(1, 5) : $color;
            return <<<HTML
                <$headerVer class="typewriter-v2 gradient" id="v{$color}">$empty
                    <span>$content</span>
                </$headerVer>
            HTML;
        }

        public static function multiTypewriteGradient(string $color, string $headerVer, string ...$contents) : string {
            $empty = EMPTY_CHAR;
            $color = $color == -1 ? rand(1, 5) : $color;
            
            $dataType = '[';
            $numContents = func_num_args() - 2; // Exclude the first two arguments (color and headerVer)

            $i = 1;
            foreach ($contents as $content) {
                $end = $i == $numContents ? '"]' : '", ';
                $dataType .= '"' . $content . $end ;
                $i++;
            }

            return <<<HTML
                <$headerVer class="typewrite gradient" id="v{$color}" data-type='$dataType' data-period="2000">
                    <span class="wrap">$empty</span>
                </$headerVer>
            HTML;
        }

        public static function multiTypewrite(string $textVer, string ...$contents) : string {
            $empty = EMPTY_CHAR;
            $dataType = '[';
            $numContents = func_num_args() - 1; // Exclude the first argument (textVer)

            $i = 1;
            foreach ($contents as $content) {
                $end = $i == $numContents ? '"]' : '", ';
                $dataType .= '"' . $content . $end ;
                $i++;
            }

            return <<<HTML
                <$textVer class="typewrite" data-type='$dataType' data-period="2000">
                    <span class="wrap">$empty</span>
                </$textVer>
            HTML;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------

    class Image {

        public static function border(string $src, string $color = EMPTY_STRING) : string {
            $colors = [PINK, BLUE, LIGHT_BLUE, PURPLE];
            $color = $color == EMPTY_STRING ? $colors[array_rand($colors)] : $color;
            return <<<HTML
                <img class="page-image interactable offset-border" id="$color" src="$src" alt="">
            HTML;
        }

        public static function standard(string $src) : string{
            return <<<HTML
                <div class="image-container">
                    <img class="page-image interactable" src="$src" alt="">
                </div>
            HTML;
        }

        public static function carousel(string ...$images) : string {
            $html = '<div class="carousel">' . PHP_EOL;
            foreach ($images as $src) {
                $html .= '    <img class="interactable" src="' . $src . '" alt="">';
            }
            $html .= '</div>';
            return $html;
        }
    }


    class Adrian {

        public static function social($name, $link, $bx) : void {
            echo <<<HTML
                <li>
                    <a class="icon $name" href="$link" target="_blank">
                        <i class="bx bxl-$bx"></i>
                    </a>
                </li>
            HTML;
        }

        public static function resume($showResume = false) : void {
            if ($showResume) {
                echo <<<HTML
                    <a href=""><h3>View My Resume</h3></a>
                HTML;
            }
        }
    }

    class ProjectLeo {

        public static function loadWorlds() : void {
            $worlds = Image::carousel(
                // Horizon
                googleDrive("1po0KakJbpNqgJ-mXcC3N7iTRi8mqp9EC"),
                googleDrive("1UbV03CcfifPtxNjDnsnk0HOpgbfK0Zk1"),
                googleDrive("1t4KGKGLSXe4iMSsFCXr8z4M38rOZGCoO"),

                // Sylvalia
                googleDrive("1XNHbH6717AyzOsvbv-KXJW-sjUtW2khS"),
                googleDrive("11N3ghRA_W0hp1Vn3F8HEgDbWgzzRxhs7")
            );

            echo <<<HTML
                <h3 style="color: #C8E9EF;">Worlds</h3>
                $worlds
            HTML;
        }

        public static function loadChars() : void {
            $chars = Image::carousel(
                // Soren
                googleDrive("1lq2jkkx3hPlpzYt9H59Hrk8VMRdIzWZQ"),
                googleDrive("1b4Tm0db0SWFqx4JvfISenMfQnsqFDpMJ"),
                googleDrive("1XjnNDSqiqF5f1tVVHqoYUEJYLepaKtq3"),

                // Strata
                googleDrive("1e7cCGIH9rGb0PUwqZNf3ubRHel4Opjx3"),
                googleDrive("1pTeYD8FcoA07bwAEtGPIpOPPFkYwyDXW")
            );

            echo <<<HTML
                <h3 style="color: #E0E1ED;">Characters</h3>
                $chars
            HTML;
        }

        static function loadMisc() : void {
            $misc = Image::carousel(
                googleDrive("1szeyVjvJM3GQk8mYUz3AsaDseJlTfXSf")
            );

            echo <<<HTML
                <h3 style="color: #E0E1ED;">Misc.</h3>
                $misc
            HTML;
        }

        public static function loadDev(bool $showDev) : void {
            if ($showDev) {
                $devs = Image::carousel(
                    // Alioth
                    googleDrive("1fwtXeNMFmKErR2picxdYtlpX1IkJToNX"),
                    
                    // Maverick
                    googleDrive("1VV3VrMeJGNzobWEEeyILS1klZjrXMu81"),

                    // Shino
                    googleDrive("1i8nc7K6TsnBkXKeCMrst7ikihnIp2ynD"),

                    // Vex
                    googleDrive("1J8klWYcvi2444VrZ9Pvsvy4337ssItUO"),

                    // Morgan
                    googleDrive("1WCk7eTBsaoFL7A_cwyyysGHVWzVJhPKb")
                );

                echo <<<HTML
                    <h3 style="color: #C8E9EF;">In Development</h3>
                    $devs
                HTML;
            }
        }

        public static function codeContent($color, $title, $description, $image, $reversed) {
            $class = $reversed ? "code-content reverse" : "code-content";
            $content = implode(PHP_EOL, [
                Image::border($image),
                Text::typewrite(DEFAULT_PARAGRAPH, $description)
            ]);

            echo <<<HTML
                <div>
                    <h4 style="color: $color;">$title</h4>
                    <div class="$class">
                        $content
                    </div>
                </div>
            HTML;
        }
    }

    class Website {
        public static function codeContent() {
            echo <<<HTML
                <h3 style="color: #E0E1ED;">Code</h3>
                <p>
                    This website was built from the ground up using HTML and CSS.
                    It utilizes servers-side scripting, as well as javascript for dynamic content and animations.
                </p>
                <hr>
            HTML;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------
    
    function googleDrive(string $id) : string {
        return "https://drive.google.com/thumbnail?id=" . $id . "&sz=w1000";
    }

    function screenshots(string $img) : string {
        return "assets/images/screenshots/" . $img;
    }
?>
