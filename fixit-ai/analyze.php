<?php
header("Content-Type: application/json");

$API_KEY = "AIzaSyBJXS6WI_IofZ168zCWG1AyrxWe5suRiIE";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input["image"])) {
    echo json_encode(["error" => "Image missing"]);
    exit;
}

$imageBase64 = $input["image"];

$payload = [
  "contents" => [
    [
      "parts" => [
        [
          "inline_data" => [
            "mime_type" => "image/jpeg",
            "data" => $imageBase64
          ]
        ],
        [
          "text" => "
You are an AI system for civic issue reporting.

Look at the image and identify the civic issue.

Rules:
- Respond ONLY with raw JSON
- No markdown
- No explanations
- Output must start with { and end with }

Return EXACTLY this format:
{\"type\":\"pothole\",\"severity\":6}
"
        ]
      ]
    ]
  ]
];

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=$API_KEY";

$ch = curl_init($url);
curl_setopt_array($ch, [
  CURLOPT_POST => true,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (!isset($data["candidates"][0]["content"]["parts"][0]["text"])) {
  echo json_encode(["error" => "Invalid AI response", "raw" => $data]);
  exit;
}

echo json_encode([
  "result" => $data["candidates"][0]["content"]["parts"][0]["text"]
]);
