// Lógica do evento de "Alugar"
const btnAlugar = document.querySelector('.btn-alugar');
if (btnAlugar) {
  btnAlugar.addEventListener('click', function() {
    // lógica do evento de alugar
  });
} else {
  console.error('Elemento não encontrado');
}

// Modal de login
const loginBtn = document.querySelector(".btn-login");
const modal = document.createElement("div");

// Criar modal de login
modal.innerHTML = `
  <div class="modal-overlay">
    <div class="modal">
      <h2>Login</h2>
      <form>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Entrar</button>
        <button type="button" class="close-modal">Cancelar</button>
      </form>
    </div>
  </div>
`;

// Estilizar modal
document.head.insertAdjacentHTML(
  "beforeend",
  `<style>
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal h2 {
      margin-top: 0;
    }

    .modal form {
      display: flex;
      flex-direction: column;
    }

    .modal input {
      margin-bottom: 10px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .modal button {
      padding: 10px;
      margin: 5px 0;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }

    .modal button[type="submit"] {
      background: var(--main-color);
      color: white;
    }

    .modal button.close-modal {
      background: var(--third-color);
      color: white;
    }
  </style>`
);

// Adicionar modal ao corpo e eventos
document.body.appendChild(modal);
modal.style.display = "none";

loginBtn.addEventListener("click", () => {
  modal.style.display = "flex";
});

modal.querySelector(".close-modal").addEventListener("click", () => {
  modal.style.display = "none";
});

modal.querySelector("form").addEventListener("submit", (e) => {
  e.preventDefault();
  alert("Login realizado com sucesso!");
  modal.style.display = "none";
});


document.addEventListener("DOMContentLoaded", () => {
const alugarButtons = document.querySelectorAll(".btn-alugar");

alugarButtons.forEach((button) => {
    button.addEventListener("click", () => {
        if (!isUserLoggedIn()) {
            alert("Você precisa estar logado para alugar uma bicicleta.");
            return;
        }

        showRentalModal();
    });
});
});

// Função para verificar se o usuário está logado
function isUserLoggedIn() {
// Esta função deve ser ajustada para verificar o estado de login real do usuário.
return true; // Simula um usuário logado.
}

// Função para exibir o modal de aluguel
function showRentalModal() {
const modalHTML = `
    <div class="modal" id="rentalModal">
        <div class="modal-content">
            <h2>Alugar Bicicleta</h2>
            <label for="rentalTime">Alugar por (horas):</label>
            <input type="number" id="rentalTime" min="1" value="1">
            <label for="rentalDate">Escolha uma data:</label>
            <input type="date" id="rentalDate">
            <button id="confirmRental">Confirmar Aluguel</button>
            <button id="closeModal">Fechar</button>
        </div>
    </div>
`;
document.body.insertAdjacentHTML("beforeend", modalHTML);

document.getElementById("confirmRental").addEventListener("click", confirmRental);
document.getElementById("closeModal").addEventListener("click", closeModal);
}

// Função para confirmar o aluguel
function confirmRental() {
const rentalTime = document.getElementById("rentalTime").value;
const rentalDate = document.getElementById("rentalDate").value;

if (!rentalDate) {
    alert("Por favor, selecione uma data válida.");
    return;
}

// Aqui você pode integrar com o banco de dados para salvar a locação.
console.log(`Aluguel confirmado: ${rentalTime} horas no dia ${rentalDate}`);

alert("Compra realizada, obrigado pela preferência!");
closeModal();
}

// Função para fechar o modal
function closeModal() {
const modal = document.getElementById("rentalModal");
if (modal) {
    modal.remove();
}
}


// avaliacoes
document.addEventListener("DOMContentLoaded", async () => {
const reviewsContainer = document.getElementById("avaliacoes");

try {
  // Simulação de fetch ao servidor
  const response = await fetch("/api/reviews"); // Endpoint do servidor
  const reviews = await response.json();

  // Renderizar avaliações
  reviewsContainer.innerHTML = reviews
    .map(
      (review) => `
    <div class="review">
      <p><strong>${review.nome}:</strong> "${review.mensagem}"</p>
    </div>
  `
    )
    .join("");
} catch (error) {
  console.error("Erro ao carregar as avaliações:", error);
  reviewsContainer.innerHTML = "<p>Não foi possível carregar as avaliações.</p>";
}
});
const reviews = [
'"Ótima experiência! A bicicleta era confortável e bem cuidada." - Maria S.',
'"Destinos incríveis, recomendo para quem ama aventura!" - João P.',
'"Serviço excelente, voltarei a usar em breve!" - Ana C.',
'"Muito prático e rápido, adorei a experiência!" - Carlos T.',
'"Bicicletas em excelente estado e atendimento ágil!" - Beatriz M.'
];

let currentReviewIndex = 0;

function navigateReview(direction) {
currentReviewIndex += direction;

if (currentReviewIndex < 0) {
  currentReviewIndex = reviews.length - 1; // Voltar ao final
} else if (currentReviewIndex >= reviews.length) {
  currentReviewIndex = 0; // Voltar ao início
}

document.getElementById('review-text').innerText = reviews[currentReviewIndex];
}

