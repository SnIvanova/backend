<?php

class NewsForm {
    
    public static function createForm() {
        $form = '<form action="process_form.php" method="post">
                    <div class="form-group">
                        <label for="title_it">Title (Italiano):</label>
                        <input type="text" class="form-control" id="title_it" name="title_it" required>
                    </div>
                    <div class="form-group">
                        <label for="title_en">Title (English):</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" required>
                    </div>
                    <div class="form-group">
                        <label for="content_it">Content (Italiano):</label>
                        <textarea class="form-control" id="content_it" name="content_it" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content_en">Content (English):</label>
                        <textarea class="form-control" id="content_en" name="content_en" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>';

        return $form;
    }
}

?>

