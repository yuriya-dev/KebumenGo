<?php
header('Content-Type: application/json');
echo json_encode(['extensions' => get_loaded_extensions()]);
