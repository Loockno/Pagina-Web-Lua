// js/chat.js
document.addEventListener("DOMContentLoaded", () => {
    const chatBox = document.getElementById('chat-box');
    const userInput = document.getElementById('user-input');

    const mezcalOptions = [
        {
            id: 1,
            name: "Mezcal Espadín",
            description: "Mezcal joven con notas ahumadas y frutales.",
            price: 39.99,
            volume: 750,
            image: "botella_Espadin.png"
        },
        {
            id: 2,
            name: "Mezcal Tobalá",
            description: "Mezcal artesanal de agave Tobalá, suave y aromático.",
            price: 59.99,
            volume: 750,
            image: "botella_Tobala.png"
        },
        {
            id: 3,
            name: "Mezcal Arroqueño",
            description: "Mezcal de agave Arroqueño con sabores intensos y complejos.",
            price: 79.99,
            volume: 750,
            image: "botella_Arroqueno.png"
        },
        {
            id: 4,
            name: "Mezcal Jabalí",
            description: "Mezcal joven con un toque de picante y notas herbales.",
            price: 29.99,
            volume: 750,
            image: "botella_Jabali.png"
        },
        {
            id: 5,
            name: "Mezcal Ensamble",
            description: "Mezcla de agaves espadín, tobalá y arroqueño, equilibrado y suave.",
            price: 49.99,
            volume: 750,
            image: "botella_Ensamble.png"
        }
    ];

    const recipes = [
        {
            id: 1,
            name: "Margarita Mezcal",
            mezcalId: 1,
            ingredients: "2 oz de Mezcal, 1 oz de jugo de limón, 1/2 oz de triple sec, Sal para el borde del vaso",
            instructions: "1. Frotar el borde del vaso con limón y sumergir en sal. 2. Mezclar todos los ingredientes con hielo y agitar bien. 3. Colar en el vaso preparado.",
            image: "coctel_Margarita.png",
            description: "La Margarita de Mezcal es una versión audaz y robusta del clásico Margarita. Usando mezcal en lugar de tequila, este cóctel incorpora un sabor ahumado que complementa perfectamente la frescura del jugo de limón y el toque salado del borde del vaso."
        },
        {
            id: 2,
            name: "Paloma Mezcal",
            mezcalId: 2,
            ingredients: "2 oz de Mezcal, 6 oz de jugo de toronja, 1/2 oz de jarabe de agave, 1/2 oz de jugo de lima, Soda de toronja, Sal para el borde del vaso",
            instructions: "1. Frotar el borde del vaso con lima y sumergir en sal. 2. Mezclar el Mezcal, jugo de toronja, jugo de lima y jarabe de agave en el vaso. 3. Añadir hielo y completar con soda de toronja.",
            image: "coctel_Paloma.png",
            description: "Paloma Mezcal combina la profundidad ahumada del mezcal con la ligereza y acidez del jugo de toronja, creando una bebida perfectamente equilibrada. Es ideal para disfrutar en una tarde calurosa, ofreciendo un refresco sofisticado con un toque mexicano."
        },
        {
            id: 3,
            name: "Mezcal Mule",
            mezcalId: 3,
            ingredients: "2 oz de Mezcal, 6 oz de ginger beer, 1/2 oz de jugo de limón, Rodaja de limón y menta para decorar",
            instructions: "1. Llenar un vaso alto con hielo. 2. Añadir el mezcal y el jugo de limón al vaso. 3. Completar con ginger beer. 4. Remover suavemente y decorar con rodaja de limón y hojas de menta.",
            image: "coctel_Mule.png",
            description: "Mezcal Mule es un giro intrigante en el clásico Moscow Mule, donde el mezcal reemplaza al vodka. La combinación de mezcal con cerveza de jengibre y jugo de lima crea un cóctel vibrante y picante, ideal para aquellos que buscan una experiencia de sabor única y estimulante."
        },
        {
            id: 4,
            name: "Fresa y Humo",
            mezcalId: 4,
            ingredients: "2 oz de Mezcal, 1 oz de jugo de fresa fresca, 1/2 oz de jugo de limón, 1/2 oz de jarabe simple, Fresas frescas y hojas de menta para decorar",
            instructions: "1. En un shaker, combinar el mezcal, jugo de fresa, jugo de limón y jarabe simple con hielo. 2. Agitar bien hasta que la mezcla esté bien fría. 3. Colar en un vaso lleno de hielo. 4. Decorar con fresas frescas y hojas de menta.",
            image: "coctel_Fresa.png",
            description: "Fresa y Humo es un cóctel que captura la esencia del verano con un toque ahumado. La combinación de mezcal, jugo de fresa fresca y limón crea una mezcla refrescante y frutal, perfecta para disfrutar en una tarde de relax."
        },
        {
            id: 5,
            name: "Oaxaca Old Fashioned",
            mezcalId: 5,
            ingredients: "2 oz de Mezcal, 1 barra de azúcar, Unas gotas de angostura, Una rodaja de naranja, Hielo",
            instructions: "1. Colocar la barra de azúcar en el vaso. 2. Añadir unas gotas de angostura y un poco de agua. 3. Mezclar hasta disolver el azúcar. 4. Llenar el vaso con hielo y añadir el mezcal. 5. Remover suavemente. 6. Adornar con la rodaja de naranja.",
            image: "coctel_Oaxaca.png",
            description: "Oaxaca Old Fashioned es una reinterpretación del clásico Old Fashioned, utilizando mezcal en lugar de bourbon. Este cóctel mezcla el dulzor característico de la barrica de azúcar con el toque distintivo y ahumado del mezcal, ofreciendo una experiencia de degustación profunda y enriquecedora."
        }
    ];

    const appendMessage = (message, sender) => {
        const messageElement = document.createElement('div');
        messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
        chatBox.appendChild(messageElement);
        chatBox.scrollTop = chatBox.scrollHeight;
    };

    const findMezcalByName = (name) => {
        return mezcalOptions.find(mezcal => mezcal.name.toLowerCase() === name.toLowerCase());
    };

    const findRecipeByMezcalId = (mezcalId) => {
        return recipes.find(recipe => recipe.mezcalId === mezcalId);
    };

    let lastMezcal = null;

    window.sendMessage = async () => {
        const message = userInput.value.trim();
        if (message === "") return;

        appendMessage(message, "Tú");
        userInput.value = "";

        const additionalInformation = {
            recetas: recipes,
            mezcales: mezcalOptions,
            funciones: [
                {
                    Function: "getMezcalDetails",
                    Description: "Buscar detalles de un mezcal específico por su ID.",
                    Input: "ID_mezcal",
                    Output: "Detalles del mezcal (nombre, descripción, precio, volumen, imagen, tipo)"
                },
                {
                    Function: "getRecipeDetails",
                    Description: "Buscar detalles de una receta específica por su ID.",
                    Input: "ID_receta",
                    Output: "Detalles de la receta (nombre, ingredientes, instrucciones, imagen, descripción)"
                },
                {
                    Function: "calculateBudget",
                    Description: "Calcular el presupuesto total para una lista de mezcales.",
                    Input: "Lista de IDs de mezcales",
                    Output: "Presupuesto total y desglose por cada mezcal"
                }
            ]
        };

        try {
            const response = await fetch('https://api.openai.com/v1/chat/completions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '
                },
                body: JSON.stringify({
                    model: 'gpt-3.5-turbo',
                    messages: [
                        { role: 'system', content: `Eres un asistente que ayuda a recomendar mezcales y proporcionar detalles sobre recetas de mezcal. Aquí tienes información adicional: ${JSON.stringify(additionalInformation)}` },
                        { role: 'user', content: message }
                    ]
                })
            });

            const data = await response.json();
            let aiResponse = data.choices[0].message.content;

            if (message.toLowerCase().includes("recomiendame un mezcal")) {
                lastMezcal = mezcalOptions[2]; // Por ejemplo, Mezcal Arroqueño
                aiResponse = `Claro, te recomendaría el ${lastMezcal.name}. Es un ${lastMezcal.description} que seguro te sorprenderán. Tiene un precio de $${lastMezcal.price} por una botella de ${lastMezcal.volume} ml. Su imagen la puedes ver aquí: ![${lastMezcal.name}](${lastMezcal.image})`;
            } else if (message.toLowerCase().includes("dame una receta con ese mezcal") && lastMezcal) {
                const recipe = findRecipeByMezcalId(lastMezcal.id);
                if (recipe) {
                    aiResponse = `Claro, te recomendaría la receta ${recipe.name} con ${lastMezcal.name}.<br><br>Ingredientes: ${recipe.ingredients}<br><br>Instrucciones: ${recipe.instructions}<br><br>![${recipe.name}](${recipe.image})`;
                } else {
                    aiResponse = `Lo siento, no encontré una receta específica para el ${lastMezcal.name}.`;
                }
            } else if (message.toLowerCase().includes("cuanto seria de 100 botellas") && lastMezcal) {
                const totalPrice = (lastMezcal.price * 100).toFixed(2);
                aiResponse = `El precio total de 100 botellas de ${lastMezcal.name} sería $${totalPrice}.`;
            }

            appendMessage(aiResponse.replace(/\n/g, '<br>'), "Mezcalion");
        } catch (error) {
            console.error("Error enviando el mensaje:", error);
            appendMessage("Error al comunicarse con el asistente.", "Mezcalion");
        }
    };
});
