let span =document.getElementById('spanPlus')

span.addEventListener("click", function () {
  

  const div = document.createElement('div')

  const idRecipe = document.createElement('input');
  idRecipe.type = 'hidden';
  idRecipe.name = 'recipe_id';

  const labelName = document.createElement('label');
  labelName.setAttribute("for", "name");
  labelName.textContent = "Nom de l'ingrédient :";
  const nameIngredient = document.createElement('input');
  nameIngredient.type = 'text';
  nameIngredient.name = 'name';

  const quantityIngredient = document.createElement('input');
  const labelQuantity = document.createElement('label');
  labelQuantity.setAttribute("for", "quantity");
  labelQuantity.textContent = "Quantité";
  quantityIngredient.type = 'text';
  quantityIngredient.name = 'quantity';


  const labelUnity = document.createElement('label')
  labelUnity.setAttribute("for", "unity");
  labelUnity.textContent = "Unité";
  const selectUnity = document.createElement('select');
  selectUnity.setAttribute('name', 'unity');
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




  div.appendChild(idRecipe);
  div.appendChild(labelName);
  div.appendChild(nameIngredient);
  div.appendChild(labelQuantity);
  div.appendChild(quantityIngredient);
  div.appendChild(labelUnity);
  div.appendChild(selectUnity);
  formIngredient.appendChild(div);
  
})