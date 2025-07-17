<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apple Style Calculator</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f2f2f7;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            padding-top: 40px;
        }

        .calculator {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 340px;
            padding: 24px;
        }

        .display {
            background: #e5e5ea;
            border-radius: 12px;
            font-size: 2.5rem;
            padding: 20px;
            text-align: right;
            margin-bottom: 20px;
            overflow-x: auto;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        button {
            background: #f9f9f9;
            border: none;
            border-radius: 12px;
            padding: 20px;
            font-size: 1.25rem;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            box-shadow: inset 0 -1px 1px rgba(0, 0, 0, 0.05);
        }

        button:active {
            transform: scale(0.98);
            background: #e0e0e0;
        }

        .operator {
            background: #007aff;
            color: white;
        }

        .operator:active {
            background: #0051c7;
        }

        .wide {
            grid-column: span 2;
        }

        .history {
            margin-top: 20px;
            max-height: 150px;
            overflow-y: auto;
            background: #f0f0f5;
            border-radius: 12px;
            padding: 10px;
            font-size: 1rem;
        }

        .history-entry {
            padding: 6px 0;
            border-bottom: 1px solid #ddd;
        }

        header {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }

        .WindowControll_close {
            background-color: red;
            width: 1vw;
            text-align: center;
            margin: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<header>
    <a href="<?php echo "/LemonOS/public/home/index.php" ?>">
        <p class="WindowControll_close">X</p>
    </a>
</header>
<div class="calculator">
    <div id="display" class="display">0</div>
    <div class="buttons">
        <button onclick="clearDisplay()">AC</button>
        <button onclick="input('%')">%</button>
        <button onclick="input('/')">÷</button>
        <button class="operator" onclick="input('*')">×</button>

        <button onclick="input('7')">7</button>
        <button onclick="input('8')">8</button>
        <button onclick="input('9')">9</button>
        <button class="operator" onclick="input('-')">−</button>

        <button onclick="input('4')">4</button>
        <button onclick="input('5')">5</button>
        <button onclick="input('6')">6</button>
        <button class="operator" onclick="input('+')">+</button>

        <button onclick="input('1')">1</button>
        <button onclick="input('2')">2</button>
        <button onclick="input('3')">3</button>
        <button class="operator" onclick="calculate()">=</button>

        <button class="wide" onclick="input('0')">0</button>
        <button onclick="input('.')">.</button>
    </div>
    <div id="history" class="history"></div>
</div>

<script>
    const display = document.getElementById('display');
    const history = document.getElementById('history');

    function input(value) {
        if (display.innerText === "0") {
            display.innerText = value;
        } else {
            display.innerText += value;
        }
    }

    function clearDisplay() {
        display.innerText = "0";
    }

    function calculate() {
        try {
            const result = eval(display.innerText);
            const entry = document.createElement('div');
            entry.classList.add('history-entry');
            entry.innerText = display.innerText + ' = ' + result;
            history.prepend(entry);
            display.innerText = result;
        } catch (e) {
            display.innerText = "Error";
        }
    }
</script>
</body>
</html>