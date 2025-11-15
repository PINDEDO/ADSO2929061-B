

interface Weapon {
    name: string;
    damage: number;
    range: number;
}

const needle: Weapon = {
    name: 'Silken Needle',
    damage: 15,
    range: 3
}

const output02 = document.getElementById('output');


if(output02){
    output02.innerHTML= 
    '<li><strong><Weapon:</stong> ${needle.name}</li>'
    '<li><strong><Weapon:</stong> ${needle.damage}</li>'
    '<li><strong><Weapon:</stong> ${needle.range}</li>'
    
}