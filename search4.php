<?php
    if(isset($_POST['search'])) {
        // Get the search term from the form
        $searchTerm = $_POST['search'];
        
        // Load the content of the homepage
        $homepageContent = file_get_contents("final1.html");
        
        // Check if the search term exists in the homepage content
        if(strpos($homepageContent, $searchTerm) !== false) {
            // Display the homepage content with the searched word highlighted
            $highlightedContent = str_ireplace($searchTerm, "<mark>$searchTerm</mark>", $homepageContent);
            echo $highlightedContent;
            // Scroll to the first occurrence of the searched word using JavaScript
            echo '<script>
                    window.onload = function() {
                        var element = document.querySelector("mark");
                        element.scrollIntoView({ behavior: "smooth", block: "center", inline: "nearest" });
                    }
                  </script>';
        } else {
            echo "The word '$searchTerm' is not found on the homepage.";
        }
    } else {
        echo "No search term provided.";
    }
    ?>