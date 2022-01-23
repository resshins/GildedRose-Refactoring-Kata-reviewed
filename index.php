<html>
    <head>
        <link rel="stylesheet" href="assets\css\main.css?v=1">
    </head>
    <body>
        <form>      
            <input name="name" type="text" class="feedback-input" placeholder="Item name" />   
            <input name="days" type="number" class="feedback-input" placeholder="Days before expiration" />
            <input name="quality" type="number" class="feedback-input" placeholder="Quality" />
            <input type="submit" value="SUBMIT"/>
        </form>
        
        <div class="response">                        
            <?php
            require __DIR__ . '/vendor/autoload.php';
            use GildedRose\GildedRose;
            use GildedRose\Item;

            if (isset($_GET['name'])) {
                $_inputs = [ 
                    'name' => filter_var ( $_GET['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'days' => (isset($_GET['days'])?intval($_GET['days']):1) ,
                    'quality' =>  (isset($_GET['quality'])?intval($_GET['quality']):1),
                ];

                $gildedRose = new GildedRose([new Item($_inputs['name'], $_inputs['days'], $_inputs['quality'])]);
                $gildedRose->updateQuality();
                
                $items = $gildedRose->getItem(); 
                foreach ($items as $item) {
                    echo "name : " . $item->name . ", " . 
                    "Days left : " . $item->sell_in . ", " . 
                    "Quality : " . $item->quality ;
                }
            }
            ?>        
        </div>
    </body>
</html>
