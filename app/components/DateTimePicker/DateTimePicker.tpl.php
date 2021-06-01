<div class="datetimepicker <?= $componentData['classes'] ?>">
    <label><input type="date" name="<?= $componentData['dateName'] ?>"
                  value="<?= $componentData['dateValue'] ?>" <?= $componentData['required'] ? 'required' : '' ?>></label>
    <span></span>
    <label><input type="time" name="<?= $componentData['timeName'] ?>"
                  value="<?= $componentData['timeValue'] ?>" <?= $componentData['required'] ? 'required' : '' ?>></label>
</div>

