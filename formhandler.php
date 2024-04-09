<?php

header('Access-Control-Allow-Origin: http://localhost:5174');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // May also need to allow other headers depending on what your frontend sends
    header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Max-Age: 86400'); // Cache preflight response for 1 day
    exit;
}
var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture all the fields from the form
    $student_name = htmlspecialchars($_POST["student_name"]);
    $index_number = htmlspecialchars($_POST["index_number"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $email = htmlspecialchars($_POST["email"]);
    $former_school = htmlspecialchars($_POST["former_school"]);
$first_choice = htmlspecialchars($_POST["first_choice"]);
$uce_year = htmlspecialchars($_POST["uce_year"]);
$aggregate_score = htmlspecialchars($_POST["aggregate_score"]);
$english_score = htmlspecialchars($_POST["english_score"]);
$math_score = htmlspecialchars($_POST["math_score"]);
$biology_score = htmlspecialchars($_POST["biology_score"]);
$chemistry_score = htmlspecialchars($_POST["chemistry_score"]);
$physics_score = htmlspecialchars($_POST["physics_score"]);
$geography_score = htmlspecialchars($_POST["geography_score"]);
$history_score = htmlspecialchars($_POST["history_score"]);
$best_optional_subject = htmlspecialchars($_POST["best_optional_subject"]);
$best_optional_score = htmlspecialchars($_POST["best_optional_score"]);
$second_best_optional_subject = htmlspecialchars($_POST["second_best_optional_subject"]);
$second_best_optional_score = htmlspecialchars($_POST["second_best_optional_score"]);
$third_best_optional_subject = htmlspecialchars($_POST["third_best_optional_subject"]);
$third_best_optional_score = htmlspecialchars($_POST["third_best_optional_score"]);
$first_choice_combination = htmlspecialchars($_POST["first_choice_combination"]);
$second_choice_combination = htmlspecialchars($_POST["second_choice_combination"]);
$third_choice_combination = htmlspecialchars($_POST["third_choice_combination"]);
$results_file_path = htmlspecialchars($_POST["results_file_path"]); // This should be the path to the uploaded file
$parent_name = htmlspecialchars($_POST["parent_name"]);
$parent_email = htmlspecialchars($_POST["parent_email"]);
$parent_tel = htmlspecialchars($_POST["parent_tel"]);
$parent_nationality = htmlspecialchars($_POST["parent_nationality"]);
$country = htmlspecialchars($_POST["country"]);
$parent_national_id = htmlspecialchars($_POST["parent_national_id"]);

    // Check if any of the required fields are empty
    if (empty($student_name) || empty($index_number) || empty($dob) || empty($email)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Required fields are missing']);
        exit();
    }

    try {
        require_once "dbh.inc.php";
        $query = "INSERT INTO student_applications (
            student_name, index_number, dob, email, former_school, first_choice, uce_year,
            aggregate_score, english_score, math_score, biology_score, chemistry_score,
            physics_score, geography_score, history_score, best_optional_subject,
            best_optional_score, second_best_optional_subject, second_best_optional_score,
            third_best_optional_subject, third_best_optional_score, first_choice_combination,
            second_choice_combination, third_choice_combination, results_file_path,
            parent_name, parent_email, parent_tel, parent_nationality, country,
            parent_national_id
        ) VALUES (
            :student_name, :index_number, :dob, :email, :former_school, :first_choice, :uce_year,
            :aggregate_score, :english_score, :math_score, :biology_score, :chemistry_score,
            :physics_score, :geography_score, :history_score, :best_optional_subject,
            :best_optional_score, :second_best_optional_subject, :second_best_optional_score,
            :third_best_optional_subject, :third_best_optional_score, :first_choice_combination,
            :second_choice_combination, :third_choice_combination, :results_file_path,
            :parent_name, :parent_email, :parent_tel, :parent_nationality, :country,
            :parent_national_id
        );";
        $stmt = $pdo->prepare($query);

        // Bind the parameters
        $stmt->bindParam(":student_name", $student_name);
        $stmt->bindParam(":index_number", $index_number);
        $stmt->bindParam(":dob", $dob);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":former_school", $former_school);
$stmt->bindParam(":first_choice", $first_choice);
$stmt->bindParam(":uce_year", $uce_year);
$stmt->bindParam(":aggregate_score", $aggregate_score);
$stmt->bindParam(":english_score", $english_score);
$stmt->bindParam(":math_score", $math_score);
$stmt->bindParam(":biology_score", $biology_score);
$stmt->bindParam(":chemistry_score", $chemistry_score);
$stmt->bindParam(":physics_score", $physics_score);
$stmt->bindParam(":geography_score", $geography_score);
$stmt->bindParam(":history_score", $history_score);
$stmt->bindParam(":best_optional_subject", $best_optional_subject);
$stmt->bindParam(":best_optional_score", $best_optional_score);
$stmt->bindParam(":second_best_optional_subject", $second_best_optional_subject);
$stmt->bindParam(":second_best_optional_score", $second_best_optional_score);
$stmt->bindParam(":third_best_optional_subject", $third_best_optional_subject);
$stmt->bindParam(":third_best_optional_score", $third_best_optional_score);
$stmt->bindParam(":first_choice_combination", $first_choice_combination);
$stmt->bindParam(":second_choice_combination", $second_choice_combination);
$stmt->bindParam(":third_choice_combination", $third_choice_combination);
$stmt->bindParam(":results_file_path", $results_file_path);
$stmt->bindParam(":parent_name", $parent_name);
$stmt->bindParam(":parent_email", $parent_email);
$stmt->bindParam(":parent_tel", $parent_tel);
$stmt->bindParam(":parent_nationality", $parent_nationality);
$stmt->bindParam(":country", $country);
$stmt->bindParam(":parent_national_id", $parent_national_id);

        // Execute the statement
        $stmt->execute();

        // Close the database connection
        $pdo = null;
        $stmt = null;

        // Redirect with a success message
        header("Location: ../application_success.php?message=User created successfully!");
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Redirect back to the form if the request method is not POST
    
    exit();
}