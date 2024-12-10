<?php
const REDIR_DEFAULT_LOC = "index.php";

const NOTIF_TYPE_ERROR = "error";
const NOTIF_TYPE_SUCCESS = "success";
const NOTIF_TYPE_WARNING = "warning";
const NOTIF_TYPE_INFO = "info";

const EXT_IMG_PROTOCOLS = [
    "http",
    "https",
];

const OEUVRES_CONSTRAINTS = [
    "Le titre ne doit pas faire plus de 50 caractères.",
    "Le nom de l'artiste ne doit pas faire plus de 30 caractères.",
    "La description ne doit pas faire plus de 65535 caractères et au moins 3 caractères.",
    "L'URL de l'image doit utiliser http ou https.",
];