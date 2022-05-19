const stepsList = document.querySelector('#stepsList');
let steps = Array.from(document.querySelectorAll('.addedStep'));
const addStepBtn = document.querySelector('#addStepBtn');
const recipeImageInput = document.querySelector('.recipeImageInput');
const recipeImageContainer = document.querySelector('.recipeImageContainer');

const defaultStep = `
            <li class="step addedStep d-flex align-items-center" style="margin-bottom: 15px;">
                <div style="margin-right: 10px">
                    <label for="uploadStepImage" class="uploadLabel">Upload image</label>
                    <input id="uploadStepImage" type="file" accept="image/*" hidden>
                </div>
                <textarea name="steps[]" id="steps" class="form-control" placeholder="Wash your hands" rows="2" style="margin-right: 10px"></textarea>
                <button type="button" class="btn-close deleteStepBtn"></button>
            </li>
`;



addStepBtn.addEventListener('click', (e) => {
    stepsList.insertAdjacentHTML('beforeend', defaultStep);
    steps = Array.from(document.querySelectorAll('.addedStep'));

    steps.forEach((item) => {
        const deleteButton = item.querySelector('.deleteStepBtn');
        deleteButton.addEventListener('click', (e) => {
            console.log('remove')
            item.remove();
        })
    })
})

recipeImageInput.addEventListener('change', (e) => {
    const file = recipeImageInput.files[0];
    const url = URL.createObjectURL(file);

    recipeImageContainer.insertAdjacentHTML('afterbegin', `<img class="preview" src=${url} alt='step'>`)
})