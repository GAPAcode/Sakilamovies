<div class="jumbotron">
    <h1>Hey, welcome again <?php echo $_SESSION["user_manager"] ?></h1>
</div>

<div id="chart1">
    <div class="mb-3 py-2 bg-dark pl-3">
        <h3 class="text-light">Sales by Category</h3>
    </div>
    <canvas id="salesByCategory" class="w-100" height="400">
    </canvas>
</div>

<div id="chart2">
    <div class="mb-3 py-2 bg-dark pl-3">
        <h3 class="text-light">Daily Sales</h3>
    </div>

    <canvas id="dailySalesChart" class="w-100" height="400">
    </canvas>
</div>