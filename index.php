<?php
if (isset($_POST['expression'])) {
    $expression = $_POST['expression'];
    $result = @eval("return $expression;") ?: 'Error';
    echo $result;
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; background: #222; color: white; }
        .calculator { width: 250px; margin: auto; padding: 20px; background: #333; border-radius: 10px; }
        .display { width: 100%; font-size: 24px; text-align: right; margin-bottom: 10px; }
        .buttons { display: grid; grid-template-columns: repeat(4, 1fr); gap: 5px; }
        button { padding: 15px; font-size: 18px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="calculator">
        <input type="text" id="display" class="display" readonly>
        <div class="buttons">
            <button onclick="clearDisplay()">C</button>
            <button onclick="deleteLast()">←</button>
            <button onclick="appendToDisplay('/')">÷</button>
            <button onclick="appendToDisplay('*')">×</button>
            <button onclick="appendToDisplay('7')">7</button>
            <button onclick="appendToDisplay('8')">8</button>
            <button onclick="appendToDisplay('9')">9</button>
            <button onclick="appendToDisplay('-')">−</button>
            <button onclick="appendToDisplay('4')">4</button>
            <button onclick="appendToDisplay('5')">5</button>
            <button onclick="appendToDisplay('6')">6</button>
            <button onclick="appendToDisplay('+')">+</button>
            <button onclick="appendToDisplay('1')">1</button>
            <button onclick="appendToDisplay('2')">2</button>
            <button onclick="appendToDisplay('3')">3</button>
            <button onclick="calculateResult()">=</button>
            <button onclick="appendToDisplay('0')">0</button>
            <button onclick="appendToDisplay('.')">.</button>
        </div>
    </div>
    <script>
        function appendToDisplay(value) {
            document.getElementById('display').value += value;
        }
        function clearDisplay() {
            document.getElementById('display').value = '';
        }
        function deleteLast() {
            let display = document.getElementById('display');
            display.value = display.value.slice(0, -1);
        }
        function calculateResult() {
            let expression = document.getElementById('display').value;
            fetch('', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: 'expression=' + encodeURIComponent(expression) })
                .then(response => response.text())
                .then(result => document.getElementById('display').value = result);
        }
    </script>
</body>
</html>
