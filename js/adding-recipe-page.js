const stepsList = document.querySelector('#stepsList');
const addStepBtn = document.querySelector('#addStepBtn');
const recipeImageInput = document.querySelector('.recipeImageInput');
const stepImageInputs = Array.from(document.querySelectorAll('.stepImageInput'));
const recipeImageContainer = document.querySelector('.recipeImageContainer');

const defaultStep = `
            <li class="step addedStep d-flex align-items-center" style="margin-bottom: 15px;">
                <div style="margin-right: 10px">
                    <div class="stepImageContainer">
                        <img class="preview" src='/Lb/images/placeholder-step.jpg' alt='step' style="object-fit: cover">
                    </div>
                    <label for="uploadStepImage" class="uploadLabel">Upload image</label>
                    <input id="uploadStepImage" class="stepImageInput" type="file" accept="image/*" hidden>
                </div>
                <textarea name="steps[]" id="steps" class="form-control" placeholder="Wash your hands" rows="2" style="margin-right: 10px"></textarea>
                <button type="button" class="btn-close deleteStepBtn"></button>
            </li>
`;

function setStepImage(e) {
    console.log('change')
    if (e.target.matches('.stepImageInput')) {
        const file = e.target.files[0];

        let container = e.target.previousElementSibling;
        while(container) {
            if(container.matches('.stepImageContainer')) {
                break;
            }
            container = container.previousElementSibling;
        }
        container.children[0].src = URL.createObjectURL(file);
    }
}

stepImageInputs[0].addEventListener('change', setStepImage)

addStepBtn.addEventListener('click', (e) => {
    stepsList.insertAdjacentHTML('beforeend', defaultStep);

    stepsList.addEventListener('click', function (e) {
        if (e.target.classList.contains('deleteStepBtn')) {
            e.target.closest('li').remove();
        }
    })

    stepsList.addEventListener('change', (e) => {
        if(e.target.matches('.stepImageInput')) setStepImage(e);
    })
})

recipeImageInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    recipeImageContainer.children[0].src = URL.createObjectURL(file);
})