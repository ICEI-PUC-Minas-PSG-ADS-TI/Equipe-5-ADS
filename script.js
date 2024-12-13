  document.addEventListener('DOMContentLoaded', function() {
    // Função para inicializar o carrossel
    function initializeCarousel() {
      const nextButton = document.querySelector('.carousel-next');
      const prevButton = document.querySelector('.carousel-prev');

      if (nextButton && prevButton) {
        nextButton.addEventListener('click', function() {
          const carouselContent = document.querySelector('.carousel-content');
          carouselContent.scrollBy({ left: 300, behavior: 'smooth' }); // Movendo o carrossel para a direita
        });

        prevButton.addEventListener('click', function() {
          const carouselContent = document.querySelector('.carousel-content');
          carouselContent.scrollBy({ left: -300, behavior: 'smooth' }); // Movendo o carrossel para a esquerda
        });
      } else {
        console.error('Botões do carrossel não encontrados');
      }
    }

    initializeCarousel();
  });


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

    // Botão de sair
  document.addEventListener("DOMContentLoaded", function () {
    const userButton = document.getElementById("userButton");
    const logoutMenu = document.getElementById("logoutMenu");
  
    userButton.addEventListener("click", function () {
      if (logoutMenu.style.display === "none" || logoutMenu.style.display === "") {
        logoutMenu.style.display = "block";
      } else {
        logoutMenu.style.display = "none";
      }
    });
  
    document.addEventListener("click", function (event) {
      if (!userButton.contains(event.target) && !logoutMenu.contains(event.target)) {
        logoutMenu.style.display = "none";
      }
    });
  });
  
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