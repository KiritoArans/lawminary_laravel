<div class="time-filter">
    <button id="daily" onclick="filterData('daily')" class="time-button">
        Daily
    </button>
    <button id="weekly" onclick="filterData('weekly')" class="time-button">
        Weekly
    </button>
    <button id="monthly" onclick="filterData('monthly')" class="time-button">
        Monthly
    </button>
    <button id="yearly" onclick="filterData('yearly')" class="time-button">
        Yearly
    </button>
</div>

<div class="col-12 chart-container" id="engagementChartContainer">
    <div class="chart-header">
        <i
            class="fas fa-minus minimize-icon minimize-chart"
            onclick="toggleChart('engagementChartContainer', this)"
        ></i>
    </div>
    <canvas id="engagementChart" width="400" height="200"></canvas>
</div>

<div class="col-12 chart-container" id="lawyerResponseChartContainer">
    <div class="chart-header">
        <i
            class="fas fa-minus minimize-icon minimize-chart"
            onclick="toggleChart('lawyerResponseChartContainer', this)"
        ></i>
    </div>
    <canvas id="lawyerResponseChart" width="400" height="200"></canvas>
</div>

<div class="col-12 chart-container" id="myChartContainer">
    <div class="chart-header">
        <i
            class="fas fa-minus minimize-icon minimize-chart"
            onclick="toggleChart('myChartContainer', this)"
        ></i>
    </div>
    <canvas id="myChart" width="400" height="200"></canvas>
</div>

<div class="col-12 chart-container" id="myPieChartContainer">
    <div class="chart-header">
        <i
            class="fas fa-minus minimize-icon minimize-chart"
            onclick="toggleChart('myPieChartContainer', this)"
        ></i>
    </div>
    <canvas id="myPieChart" width="600" height="300"></canvas>
</div>

<div class="col-12 chart-container" id="myLineChartContainer">
    <div class="chart-header">
        <i
            class="fas fa-minus minimize-icon minimize-chart"
            onclick="toggleChart('myLineChartContainer', this)"
        ></i>
    </div>
    <canvas id="myLineChart" width="100" height="50"></canvas>
</div>
