<form method='POST' action='/translate'>
    <div class='form-group'>
        <label for='sourceLanguage'>Choose your starting language:</label>
        <select name='sourceLanguage' id='sourceLanguage' class='form-control'>
            <option value='auto'>Auto-Identify</option>
            <option value='en'>English</option>
            <option value='de'>German</option>
            <option value='es'>Spanish</option>
            <option value='fr'>French</option>
            <option value='pt'>Portuguese</option>
            <option value='zh'>Chinese (Simplified)</option>
            <option value='ar'>Arabic</option>
        </select>
        <label for='targetLanguage'>Choose your ending language:</label>
        <select name='targetLanguage' id='targetLanguage' class='form-control'>
            <option value='de'>German</option>
            <option value='es'>Spanish</option>
            <option value='fr'>French</option>
            <option value='pt'>Portuguese</option>
            <option value='zh'>Chinese (Simplified)</option>
            <option value='ar'>Arabic</option>
            <option value='en'>English</option>
        </select>
        <label>Enter your text to be translated:
            <input type='text' name='translateText' class='form-control' id='translateText'
                   value='Test post please ignore.'></label>
        <div id='submit'>
            <input type='submit' value='Translate' class='btn btn-primary btn-md'>
        </div>
    </div>
</form>