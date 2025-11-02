const BASE_URL = "http://localhost:8080/api/"; // URL de tus endpoints

// Obtener datos (GET)
async function apiGet(endpoint) {
  try {
    const res = await fetch(BASE_URL + endpoint);
    if (!res.ok) throw new Error("Error al obtener datos");
    return await res.json();
  } catch (err) {
    console.error(err);
    return null;
  }
}

// Enviar datos (POST, PUT, DELETE)
async function apiSend(endpoint, data, method = "POST") {
  try {
    const res = await fetch(BASE_URL + endpoint, {
      method,
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });
    if (!res.ok) throw new Error("Error al enviar datos");
    return await res.json();
  } catch (err) {
    console.error(err);
    return null;
  }
}
