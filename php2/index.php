<!DOCTYPE html>
<html lang="en" data-theme="forest">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-0">
    <div class="header w-full text-3xl bg-neutral p-5 font-bold text-neutral-content text-center ">
        Roaster of Team Webprog
        <a class="btn btn-primary font-bold ml-10 mt-1" href="addplayer.php">Add player</a>
    </div>
    <div
        class="w-[80vw] mx-auto mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-[80vh] overflow-y-scroll ">
        <?php
        $one1 = 'players.json';  // Ensure this is the correct path to your JSON file
        $two2 = file_get_contents($one1);
        $players = json_decode($two1, true);

        foreach ($players as $player) {
            echo '<div class="card card-side bg-base-300 shadow-xl">';
            echo '<figure class="h-full"><img src="./img/' . $player['img'] . '.jpg" class="h-full w-48 object-cover" /></figure>';
            echo '<div class="card-body mx-auto text-center w-full p-3 my-auto">';
            echo '<h2 class="card-title text-center block">' . $player['name'] . '</h2>';
            echo '<div class="card-actions mx-auto text-center block">';
            foreach ($player['positions'] as $position) {
                echo '<div class="badge badge-primary">' . $position . '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        foreach ($players as $player) {
            $thisyear = $player['goals2024'];
            $lastyear = $player['goals2023'];
            $diff = $thisyear - $lastyear;
            $result = "Same as last season";  // Default message

            if ($diff > 0) {
                $more = round(($diff / max($lastyear, 1)) * 100);  // Avoid division by zero
                $result = $more . "% more than last season";
            } elseif ($diff < 0) {
                $result = "Less than last season";
            }
            echo '<figure class="h-full"><img src="./img/' . $player['img'] . '.jpg" class="h-full w-48 object-cover" /></figure>';
            echo '<h2 class="card-title text-center block">' . $player['name'] . '</h2>';
            echo '<div class="stat-value">' . $thisyear . ' goals in 2024</div>';
            echo '<div class="stat-desc">' . $result . '</div>';
        }
        ?>
        <!-- Beginning of the cards -->
        <div class="card card-side bg-base-300 shadow-xl">
            <figure class="h-full"><img src="./img/valentino.jpg" class="h-full w-48 object-cover" />
            </figure>
            <div class="card-body mx-auto text-center w-full p-3 my-auto">
                <h2 class="card-title text-center block">Valentino Alfonzo</h2>
                <div class="card-actions mx-auto text-center block">
                    <div class="badge badge-primary">Striker</div>
                    <div class="badge badge-outline">Winger</div>
                    <div class="stat">
                        <div class="stat-title">Goals this season</div>
                        <div class="stat-value">30</div>
                        <div class="stat-desc">21% more than last season</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-side bg-base-300 shadow-xl ">
            <figure class="h-full"><img src="./img/kiss.jpg" class="h-full w-48 object-cover" />
            </figure>
            <div class="card-body mx-auto text-center w-full p-3 my-auto">
                <h2 class="card-title text-center block">Level Géza</h2>
                <div class="card-actions mx-auto text-center block">
                    <div class="badge badge-primary">Goalkeeper</div>
                    <div class="stat">
                        <div class="stat-title">Goals this season</div>
                        <div class="stat-value">0</div>
                        <div class="stat-desc">Same as last season</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-side bg-base-300 shadow-xl">
            <figure class="h-full"><img src="./img/batorini.jpg" class="h-full w-48 object-cover" />
            </figure>
            <div class="card-body mx-auto text-center w-full p-3 my-auto">
                <h2 class="card-title text-center block">Benke Giroud</h2>
                <div class="card-actions mx-auto text-center block">
                    <div class="badge badge-primary">Rightback</div>
                    <div class="badge badge-outline">Leftback</div>
                    <div class="badge badge-outline">Centerback</div>
                    <div class="stat">
                        <div class="stat-title">Goals this season</div>
                        <div class="stat-value">5</div>
                        <div class="stat-desc">Less than last season</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    $one = 'players.json';
    $two = file_get_contents($one);
    $info = json_decode($two, true);
    foreach ($info as $player) {
        echo "Name: " . $player['name'] . "<br>";
        echo "Positions: " . implode(', ', $player['positions']) . "<br>";
        echo "Goals 2024: " . $player['goals2024'] . "<br>";
        echo "Goals 2023: " . $player['goals2023'] . "<br>";
        echo "Image Tag: " . $player['img'] . "<br>";
    }
    ?>
</body>

</html>