<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<svg width="800" height="500" xmlns="http://www.w3.org/2000/svg" >
  <!-- Background -->
  <rect width="100%" height="100%" fill="#f8f9fa" />

  <!-- Title -->
  

  <!-- Bar Chart -->
  <g transform="translate(50, 100) scale(1)">
    <!-- Axes -->
    <line x1="0" y1="200" x2="300" y2="200" stroke="#aaa" stroke-width="2" />
    <line x1="0" y1="0" x2="0" y2="200" stroke="#aaa" stroke-width="2" />
    <!-- Bars -->
    <rect x="20" y="150" width="30" height="50" fill="#4e79a7" />
    <rect x="70" y="120" width="30" height="80" fill="#59a14f" />
    <rect x="120" y="100" width="30" height="100" fill="#f28e2b" />
    <rect x="170" y="70" width="30" height="130" fill="#edc949" />
    <!-- Labels -->
    <text x="35" y="215" font-size="12px" text-anchor="middle">A</text>
    <text x="85" y="215" font-size="12px" text-anchor="middle">B</text>
    <text x="135" y="215" font-size="12px" text-anchor="middle">C</text>
    <text x="185" y="215" font-size="12px" text-anchor="middle">D</text>
  </g>
</svg>
</body>
</html>
