const chatbotToggler = document.querySelector(".chatbot-toggler");
const closeBtn = document.querySelector(".close-btn");
const chatbox = document.querySelector(".chatbox");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");
let userMessage = null; // Variable to store user's message
const inputInitHeight = chatInput.scrollHeight;

const createChatLi = (message, className) => {
    // Create a chat <li> element with passed message and className
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", `${className}`);
    let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
    chatLi.innerHTML = chatContent;
    chatLi.querySelector("p").textContent = message;
    return chatLi; // return chat <li> element
}


const generateResponse = (chatElement, userMessage) => {
    const messageElement = chatElement.querySelector("p");
    let responseMessage;

    // Convert the user message to lowercase for easier comparison
    const lowerCaseMessage = userMessage.toLowerCase();

    if (lowerCaseMessage.includes("hola") || lowerCaseMessage.includes("buenos días")) {
        responseMessage = "¡Hola! ¿Quieres información sobre nuestros nuevos cursos?";
    } else if (lowerCaseMessage.includes("necesito ayuda") || lowerCaseMessage.includes("problema")) {
        responseMessage = "Claro, ¿cómo puedo asistirte?";
    } else if (lowerCaseMessage.includes("cursos disponibles") || lowerCaseMessage.includes("ofertas de cursos")) {
        responseMessage = "Actualmente ofrecemos cursos de Python, Java, Kotlin, y Django. ¿Te gustaría más información sobre alguno de estos cursos?";
    } else if (lowerCaseMessage.includes("precio") || lowerCaseMessage.includes("coste")) {
        responseMessage = "Los precios de nuestros cursos varían. Por favor, comunícate al número 8999999 para obtener detalles específicos.";
    } else if (lowerCaseMessage.includes("horario") || lowerCaseMessage.includes("cuándo")) {
        responseMessage = "Nuestros cursos tienen horarios flexibles. Puedes elegir entre clases matutinas, vespertinas y nocturnas.";
    } else if (lowerCaseMessage.includes("inscripción") || lowerCaseMessage.includes("registrarse")) {
        responseMessage = "Para inscribirte en uno de nuestros cursos, visita nuestra página web o llama al número 8999999.";
    } else if(lowerCaseMessage.includes("Bc es cabro?") || lowerCaseMessage.includes("Bc")){
        responseMessage = "Confirmo que Bc es un cabro se durante el pasar de los tiempos que le gustan los negros";
    }else {
        responseMessage = "Confirmo que Bc es un cabro se durante el pasar de los tiempos que le gustan los negros";
    }

    messageElement.textContent = responseMessage;
    chatbox.scrollTo(0, chatbox.scrollHeight);
}



const handleChat = () => {
    userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
    if (!userMessage) return;

    // Clear the input textarea and set its height to default
    chatInput.value = "";
    chatInput.style.height = `${inputInitHeight}px`;

    // Append the user's message to the chatbox
    chatbox.appendChild(createChatLi(userMessage, "outgoing"));
    chatbox.scrollTo(0, chatbox.scrollHeight);

    setTimeout(() => {
        // Display "Thinking..." message while waiting for the response
        const incomingChatLi = createChatLi("Pensando...", "incoming");
        chatbox.appendChild(incomingChatLi);
        chatbox.scrollTo(0, chatbox.scrollHeight);

        // Generate response based on user's message
        generateResponse(incomingChatLi, userMessage);
    }, 600);
}

chatInput.addEventListener("input", () => {
    // Adjust the height of the input textarea based on its content
    chatInput.style.height = `${inputInitHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
});

chatInput.addEventListener("keydown", (e) => {
    // If Enter key is pressed without Shift key and the window
    // width is greater than 800px, handle the chat
    if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
        e.preventDefault();
        handleChat();
    }
});

sendChatBtn.addEventListener("click", handleChat);
closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));

//mejorar como piensa el robot.
//ver que mas puede ir.
//intentar que la ia pueda ayudar
//poner una condicional cuando pongas cualquier cosa te diga porfavor escriba coherente mente y si no sabes escriba help
//hacer un boton help