let span = document.getElementById('spanPlus')
const formAddRecipe = document.getElementById('formAddRecipe')
const formIngredient = document.getElementById('formIngredient')

let clickCount = 1;


span.addEventListener("click", function () {


  const div = document.createElement('div')

  const labelName = document.createElement('label');
  labelName.setAttribute("for", "name");
  labelName.textContent = "Nom de l'ingrédient :";
  const nameIngredient = document.createElement('input');
  nameIngredient.type = 'text';
  nameIngredient.name = 'name' + '_' + clickCount;

  const quantityIngredient = document.createElement('input');
  const labelQuantity = document.createElement('label');
  labelQuantity.setAttribute("for", "quantity");
  labelQuantity.textContent = "Quantité";
  quantityIngredient.type = 'number';
  quantityIngredient.name = 'quantity' + '_' + clickCount;


  const labelUnity = document.createElement('label')
  labelUnity.setAttribute("for", "unity");
  labelUnity.textContent = "Unité";
  const selectUnity = document.createElement('select');
  const optionBase = document.createElement('option');
  optionBase.setAttribute('value', '');
  optionBase.textContent = "Choix de l'unité";
  selectUnity.appendChild(optionBase);
  selectUnity.setAttribute('name', 'unity' + '_' + clickCount);
  selectUnity.setAttribute('id', 'unity');
  const optionNull = document.createElement('option');
  optionNull.setAttribute('value', '');
  selectUnity.appendChild(optionNull);
  const optionG = document.createElement('option');
  optionG.setAttribute('value', 'g');
  optionG.textContent = 'g';
  selectUnity.appendChild(optionG);
  const optionPincee = document.createElement('option');
  optionPincee.setAttribute('value', 'pincée');
  optionPincee.textContent = 'pincée';
  selectUnity.appendChild(optionPincee);
  const optionTranche = document.createElement('option');
  optionTranche.setAttribute('value', 'tranche');
  optionTranche.textContent = 'tranche';
  selectUnity.appendChild(optionTranche);
  const optionMl = document.createElement('option');
  optionMl.setAttribute('value', 'ml');
  optionMl.textContent = 'ml';
  selectUnity.appendChild(optionMl);
  const optionCac = document.createElement('option');
  optionCac.setAttribute('value', 'C.a.c');
  optionCac.textContent = 'cuil. à café';
  selectUnity.appendChild(optionCac);
  const optionCas = document.createElement('option');
  optionCas.setAttribute('value', 'C.a.s');
  optionCas.textContent = 'cuil. à soupe';
  selectUnity.appendChild(optionCas);





  div.appendChild(labelName);
  div.appendChild(nameIngredient);
  div.appendChild(labelQuantity);
  div.appendChild(quantityIngredient);
  div.appendChild(labelUnity);
  div.appendChild(selectUnity);
  formIngredient.prepend(div);
  clickCount++
})

/*ajax*/

formAddRecipe.addEventListener('submit', function (e) {
  e.preventDefault();



  const data = new FormData(formAddRecipe)


  fetch('./newRecipe', {
    method: 'POST',
    body: data
  })
    .then((response) => response.json())
    .then((datas) => {
      const lastInsertId = datas;
      const idRecipe = document.createElement('input');
      idRecipe.type = 'hidden';
      idRecipe.name = 'recipe_id';
      idRecipe.value = lastInsertId;
      formIngredient.append(idRecipe)
    })
    .catch(error => {
      console.log(error);
    });
  addIngredients.classList.toggle('activeIngredient');
  formAddRecipe.classList.toggle('activeRecipe');

})





