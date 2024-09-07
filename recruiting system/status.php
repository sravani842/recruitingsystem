<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Application Status Tracker</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: black;
  }
  .tracker {
    display: flex;
    justify-content: space-between;
    margin: 50px auto;
    max-width: 800px;
    position: relative;
  }
  .step {
    width: 20%;
    text-align: center;
    position: relative;
    z-index: 1;
  }
  .step:before {
    content: "";
    width: 100%;
    height: 3px;
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
  }
  .step:first-child:before {
    display: none;
  }
  .step.active {
    color: #fff;
  }
  .step.active:before {
    background-color: #007bff;
  }
  .step.complete {
    color: #e41175;
  }
  .step.complete:before {
    background-color: #e41175;
  }
  .step-title {
    margin-top: 10px;
  }
</style>
</head>
<body>

<div class="tracker">
  <div class="step active">
    <div class="step-icon">&#10003;</div>
    <div class="step-title">Application Received</div>
  </div>
  <div class="step complete">
    <div class="step-icon">&#10003;</div>
    <div class="step-title">Under Review</div>
  </div>
  <div class="step">
    <div class="step-icon">&#10003;</div>
    <div class="step-title">Interview Scheduled</div>
  </div>
  <div class="step">
    <div class="step-icon">&#10003;</div>
    <div class="step-title">Offer Made</div>
  </div>
  <div class="step">
    <div class="step-icon">&#10003;</div>
    <div class="step-title">Hired</div>
  </div>
</div>

</body>
</html>