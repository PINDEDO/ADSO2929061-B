function calculateAttack(baseDamage: number, multiplier: number): number {
    return baseDamage + multiplier;
}

const attack = calculateAttack(15, 2);




const output03 = document.getElementById('output');


if(output03){
    output03.innerHTML= 
    '<li><strong><base Damage: </stong>15</li>'
    '<li><strong><multiplier: </stong>2</li>'
    '<li><strong><Total Attack: </stong> ${attack}</li>'
}
