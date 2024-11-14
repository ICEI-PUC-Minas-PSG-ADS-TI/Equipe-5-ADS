function showReservationSummary() {
    const station = document.getElementById("station").value;
    const startDate = document.getElementById("start-date").value;
    const startTime = document.getElementById("start-time").value;
    const endDate = document.getElementById("end-date").value;
    const endTime = document.getElementById("end-time").value;

    if (station && startDate && startTime && endDate && endTime) {
        const startDateTime = new Date(`${startDate}T${startTime}`);
        const endDateTime = new Date(`${endDate}T${endTime}`);
        

        const totalMinutes = Math.floor((endDateTime - startDateTime) / 60000);
        if (totalMinutes < 30) {
            alert("O tempo mínimo de reserva é de 30 minutos.");
            return;
        }

       
        const totalPrice = (Math.ceil(totalMinutes / 30) * 3).toFixed(2);

        
        const summary = `
            <strong>Estação Selecionada:</strong> ${station}<br>
            <strong>Data e Hora de Retirada:</strong> ${startDate} ${startTime}<br>
            <strong>Data e Hora de Devolução:</strong> ${endDate} ${endTime}<br>
            <strong>Tempo Total:</strong> ${Math.floor(totalMinutes / 60)}h ${totalMinutes % 60}min<br>
            <strong>Valor Total:</strong> R$${totalPrice}
        `;
        document.getElementById("reservation-summary").innerHTML = summary;

        // Exibe o modal de confirmação
        document.getElementById("confirmation-modal").style.display = "flex";
    } else {
        alert("Por favor, preencha todos os campos.");
    }
}

function confirmReservation() {
    document.getElementById("confirmation-modal").style.display = "none";
    document.getElementById("reservation-success-modal").style.display = "flex";
}

function closeConfirmationModal() {
    document.getElementById("confirmation-modal").style.display = "none";
}

function closeSuccessModal() {
    document.getElementById("reservation-success-modal").style.display = "none";
}
