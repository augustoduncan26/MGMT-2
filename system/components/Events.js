
const { useEffect, useState } = React;

const Events = (path) => {
    const [notificaciones, setNotif] = useState([]);

    useEffect(() => {
        fetch(path.path + 'eventos.php')
        .then((res) => res.json())
        .then((data) => setNotif(data))
        .catch(err => console.error("Error:", err));
    }, []);
    return (<span>{notificaciones.total}</span>
    );
}