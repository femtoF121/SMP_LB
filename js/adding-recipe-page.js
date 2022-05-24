const stepsList = document.querySelector('#stepsList');
const addStepBtn = document.querySelector('#addStepBtn');
const recipeImageInput = document.querySelector('.recipeImageInput');
const stepImageInputs = Array.from(document.querySelectorAll('.stepImageInput'));
const recipeImageContainer = document.querySelector('.recipeImageContainer');


const defaultStep = `
            <li class="step d-flex align-items-center" style="margin-bottom: 15px;">
                <div style="margin-right: 10px">
                    <div class="stepImageContainer">
                        <img class="preview" src='/Lb/images/placeholder-step.jpg' alt='step' style="object-fit: cover">
                    </div>
                    <label class="uploadLabel">
                        Upload image
                        <input name="steps[]" class="stepImageInput" type="file" accept="image/*" hidden>
                    </label>
                </div>
                <textarea name="steps[]" id="steps" class="form-control" placeholder="Wash your hands" rows="2"
                          style="margin-right: 10px"></textarea>
                <button type="button" class="btn-close deleteStepBtn"></button>
            </li>
`;

function setStepImage(e) {
    console.log('change')
    console.log(e)
    const file = e.target.files[0];

    const previewNode = e.target.closest('li').querySelector('.preview');
    previewNode.src = URL.createObjectURL(file);
}

stepsList.addEventListener('click', function (e) {
    if (e.target.classList.contains('deleteStepBtn')) {
        e.target.closest('li').remove();
    }
})

stepsList.addEventListener('change', function (e) {
    if (e.target.matches('input.stepImageInput') && e.target.files[0]) {
        setStepImage(e)
    }

    if (e.target.matches('textarea')) {
        console.log(e.target.value)
    }
})

addStepBtn.addEventListener('click', (e) => {
    stepsList.insertAdjacentHTML('beforeend', defaultStep);
})

recipeImageInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    recipeImageContainer.children[0].src = URL.createObjectURL(file);
})