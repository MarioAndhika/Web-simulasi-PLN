<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulasi Penyambungan Kabel ke Meteran PLN</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f3f3f3;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
    }
    #container {
      display: flex;
      justify-content: space-around;
      margin-top: 50px;
      position: relative;
    }
    .panel {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }
    .point {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #95a5a6;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: white;
      font-weight: bold;
      border: 2px solid white;
    }
    .label {
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }
    canvas {
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
    }
    #controls {
      text-align: center;
      margin-top: 30px;
    }
    button {
      padding: 10px 20px;
      font-size: 16px;
      margin: 5px;
      cursor: pointer;
    }
    #lampu {
      margin-top: 20px;
      text-align: center;
    }
    .lamp {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: gray;
      display: inline-block;
      margin-top: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }
  </style>
</head>
<body>
  <h1>Simulasi Penyambungan Kabel ke Meteran PLN</h1>

  <div id="container">
    <div class="panel" id="source">
      <div><div class="point" data-side="source" data-label="L">L</div><div class="label">Sumber L</div></div>
      <div><div class="point" data-side="source" data-label="N">N</div><div class="label">Sumber N</div></div>
      <div><div class="point" data-side="source" data-label="G">G</div><div class="label">Sumber G</div></div>
    </div>

    <div class="panel" id="meter">
      <div><div class="point" data-side="meter" data-label="L">L</div><div class="label">Meteran L</div></div>
      <div><div class="point" data-side="meter" data-label="N">N</div><div class="label">Meteran N</div></div>
      <div><div class="point" data-side="meter" data-label="G">G</div><div class="label">Meteran G</div></div>
    </div>

    <canvas id="canvas"></canvas>
  </div>

  <div id="controls">
    <button onclick="resetConnections()">🔁 Reset Sambungan</button>
    <button onclick="validateConnections()">✅ Periksa Sambungan</button>
    <button onclick="startQuiz()">🎯 Latihan Kabel L</button>
    <button onclick="validateQuizConnection()">🔍 Cek Latihan</button>
    <button onclick="startRandomQuiz()">🎲 Kuis Kabel Acak</button>
  </div>

  <div id="lampu">
    <p>Lampu Status:</p>
    <div class="lamp" id="lampu-status"></div>
  </div>

  <script>
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let firstClick = null;
    const connections = [];
    let quizMode = false;
    let currentTarget = "";

    const clickSound = new Audio("https://www.soundjay.com/button/sounds/button-16.mp3");

    function getCenterPosition(el) {
      const rect = el.getBoundingClientRect();
      return {
        x: rect.left + rect.width / 2,
        y: rect.top + rect.height / 2
      };
    }

    function drawLines() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.lineWidth = 4;

      connections.forEach(conn => {
        const start = getCenterPosition(conn[0]);
        const end = getCenterPosition(conn[1]);
        const label = conn[0].dataset.label;

        if (label === "L") ctx.strokeStyle = "red";
        else if (label === "N") ctx.strokeStyle = "blue";
        else if (label === "G") ctx.strokeStyle = "green";

        ctx.beginPath();
        ctx.moveTo(start.x, start.y);
        ctx.lineTo(end.x, end.y);
        ctx.stroke();
      });
    }

    document.querySelectorAll('.point').forEach(point => {
      point.addEventListener('click', () => {
        clickSound.play();
        if (!firstClick) {
          firstClick = point;
          point.style.backgroundColor = "#f39c12";
        } else {
          if (firstClick.dataset.side !== point.dataset.side && firstClick.dataset.label === point.dataset.label) {
            connections.push([firstClick, point]);
            firstClick.style.backgroundColor = "#95a5a6";
            drawLines();
          } else {
            alert("Sambungan harus dari sumber ke meteran dan label harus sama!");
            firstClick.style.backgroundColor = "#95a5a6";
          }
          firstClick = null;
        }
      });
    });

    function resetConnections() {
      connections.length = 0;
      document.querySelectorAll('.point').forEach(p => {
        p.style.backgroundColor = "#95a5a6";
      });
      drawLines();
      document.getElementById("lampu-status").style.backgroundColor = "gray";
      document.getElementById("lampu-status").style.boxShadow = "none";
    }

    function validateConnections() {
      const required = ["L", "N", "G"];
      const connectedLabels = connections.map(conn => conn[0].dataset.label);
      const valid = required.every(label => connectedLabels.includes(label));

      if (valid) {
        alert("✅ Semua sambungan benar! Listrik menyala.");
        document.getElementById("lampu-status").style.backgroundColor = "yellow";
        document.getElementById("lampu-status").style.boxShadow = "0 0 25px yellow";
      } else {
        alert("❌ Sambungan belum lengkap atau salah.");
        document.getElementById("lampu-status").style.backgroundColor = "red";
        document.getElementById("lampu-status").style.boxShadow = "0 0 15px red";
      }
    }

    function startQuiz() {
      quizMode = true;
      currentTarget = "L";
      alert("🎯 Mode Latihan: Sambungkan kabel L saja.");
    }

    function validateQuizConnection() {
      const labels = connections.map(conn => conn[0].dataset.label);
      if (labels.length === 1 && labels[0] === currentTarget) {
        alert("✅ Benar! Kamu berhasil menyambungkan kabel " + currentTarget);
        document.getElementById("lampu-status").style.backgroundColor = "green";
        document.getElementById("lampu-status").style.boxShadow = "0 0 25px green";
      } else {
        alert("❌ Salah. Kamu hanya perlu menyambungkan kabel " + currentTarget);
        document.getElementById("lampu-status").style.backgroundColor = "red";
        document.getElementById("lampu-status").style.boxShadow = "0 0 15px red";
      }
    }

    function startRandomQuiz() {
      const options = ["L", "N", "G"];
      currentTarget = options[Math.floor(Math.random() * options.length)];
      quizMode = true;
      alert("🎯 Kuis: Sambungkan kabel " + currentTarget);
    }

    window.addEventListener('resize', () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      drawLines();
    });
  </script>
</body>
</html>