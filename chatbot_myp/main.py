from fastapi import FastAPI
from pydantic import BaseModel
from fastapi.middleware.cors import CORSMiddleware
import spacy
import unicodedata


# Cargar modelo de lenguaje en español
nlp = spacy.load("es_core_news_sm")

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)
def limpiar_texto(texto):
    texto = texto.lower()
    texto = texto.replace("á", "a").replace("é", "e").replace("í", "i").replace("ó", "o").replace("ú", "u")
    texto = texto.replace("ñ", "n")
    return texto

# Clase para recibir la pregunta
class ChatRequest(BaseModel):
    name: str
    question: str

# Diccionario de preguntas y respuestas
faq = {
    "hola": "¡Hola! ¿En qué puedo ayudarte con tu estilo o ropa hoy?",
    "buenos dias": "¡Buenos días! Estoy aquí para asesorarte en lo que necesites de moda.",
    "buenas tardes": "¡Buenas tardes! ¿Buscas algo en especial?",
    "¿puedes ayudame?": "¡Claro que sí! Puedes preguntarme por tallas, combinaciones o estilos según la ocasión.",
    "necesito ayuda": "Estoy para ayudarte. ¿Qué estás buscando hoy?",
    "gracias": "¡Con gusto! Si tienes más dudas, aquí estaré.",
    "muchas gracias": "¡Siempre es un placer ayudarte!",
    "me ayudas": "Por supuesto, dime qué necesitas saber.",
    "¿Qué me recomiendas para una salida casual?": "Puedes usar unos tenis con camiseta básica y jeans. Es un estilo cómodo y moderno.",
    "¿Qué prendas tienen para mujer?": "Contamos con blusas, pantalones, vestidos y chaquetas. ¡Puedes filtrar por talla y color!",
    "¿Como saber que talla soy?": "Consulta nuestra guía de tallas. Si estás entre dos, elige la más grande para mayor comodidad.",
    "¿Tienen ropa para clima frío?": "Sí, tenemos prendas abrigadas como chaquetas y pantalones gruesos, ideales para clima frío.",
    "¿Qué puedo combinar con unos tenis blancos?": "Los tenis blancos son muy versátiles. Van bien con jeans, pantalones beige o incluso vestidos casuales.",
    "¿Tienen ropa para ocasiones formales?": "Sí, contamos con prendas elegantes como camisas, pantalones de vestir y blusas sobrias.",
    "¿Qué significa talla S, M, L y XL?": "Son tallas estándar: S (pequeño), M (mediano), L (grande), XL (extra grande).",
    "¿Qué colores están de moda?": "Esta temporada los tonos tierra, pasteles y el negro clásico están marcando tendencia.",
    "¿Qué tipo de ropa ofrecen para hombres?": "Ofrecemos camisas, camisetas, pantalones, chaquetas y accesorios.",
    "¿Qué puedo usar para una cita romántica?": "Para mujeres, un vestido con tonos suaves. Para hombres, camisa blanca y pantalón oscuro.",
    "¿Tienen outfits completos listos para comprar?": "No por ahora, pero puedes armar uno fácilmente combinando productos por categoría.",
    "¿Cómo combino ropa con estampados?": "Usa una prenda estampada y combínala con otra de color neutro para equilibrar.",
    "¿Qué recomiendan para oficina?": "Para hombres: camisa y pantalón formal. Para mujeres: blusa elegante y pantalón o falda.",
    "¿La ropa es unisex?": "Algunas prendas sí lo son, como camisetas y chaquetas oversize. Verifica en la descripción.",
    "¿Qué usar con jeans rasgados?": "Una camiseta básica o un crop top y tenis para un look urbano.",
    "¿Cómo cuidar mi ropa para que dure más?": "Lavar a mano o con agua fría, no usar secadora y evitar el planchado excesivo.",
    "¿Qué puedo regalar a mi pareja?": "Una camiseta de su color favorito, una blusa o unos tenis siempre son buena opción.",
    "¿Qué talla es ideal para adolescentes?": "Usualmente S o M. Revisa la guía de tallas para mayor precisión.",
    "¿La ropa encoge al lavarse?": "No debería, pero sigue siempre las instrucciones de cuidado en la etiqueta.",
    "¿Qué calzado combina con pantalón negro?": "Puedes usar tenis blancos, mocasines marrones o zapatos casuales.",
    "¿Tienen prendas para adolescentes?": "Sí, nuestras tallas y estilos están pensados para jóvenes y adultos por igual.",
    "¿Qué ropa no pasa de moda?": "Camisetas blancas, jeans azules y chaquetas de mezclilla siempre están vigentes.",
    "¿Qué colores combinan con azul marino?": "Blanco, gris claro, beige o incluso un rojo vino suave.",
    "¿Puedo usar tenis con ropa formal?": "Sí, si son tenis lisos y de color neutro. Úsalos con pantalones rectos y blazer.",
    "¿Qué usar para una reunión familiar informal?": "Jeans, una blusa cómoda o camisa ligera y zapatos casuales. Relajado pero con estilo.",
    "¿Qué tipo de ropa me queda si soy bajita?": "Opta por prendas de tiro alto y evita los pantalones muy anchos. Las líneas verticales ayudan a alargar visualmente.",
    "¿Qué es un look monocromático?": "Es un atuendo compuesto por prendas del mismo color o tonos muy similares. Es elegante y alarga la figura.",
    "¿Qué puedo usar para una entrevista de trabajo?": "Ropa formal y neutra. Para mujeres: blusa y pantalón. Para hombres: camisa y pantalón de vestir.",
    "¿Qué usar con una falda larga?": "Blusas ajustadas o tops cortos para equilibrar el volumen.",
    "¿Cómo vestir para una boda de día?": "Colores claros y tejidos frescos. Evita el blanco si no eres la novia.",
    "¿Que es estilo casual chic?": "Es combinar ropa cómoda con toques elegantes. Ejemplo: jeans con blazer.",
    "¿Cómo combino ropa en tonos pastel?": "Los tonos pastel se combinan entre sí o con blancos, grises y beige.",
    "¿Qué ropa favorece si tengo caderas anchas?": "Blusas con volumen en la parte superior y pantalones de corte recto u oscuro.",
    "¿Qué usar si tengo hombros anchos?": "Faldas con volumen y tops de tiras finas o escotes en V.",
    "¿Qué prendas son básicas para tener un buen fondo de armario?": "Jeans, camiseta blanca, chaqueta de mezclilla, camisa negra y tenis blancos.",
    "¿Qué puedo usar para un evento informal en la noche?": "Jeans oscuros, blusa elegante o camisa, y zapatos casuales.",
    "¿Qué ropa es adecuada para un viaje?": "Ropa cómoda, versátil y fácil de combinar. Lleva una chaqueta ligera.",
    "¿Qué colores me favorecen si soy de piel clara?": "Colores vivos como azul rey, rojo, verde esmeralda o tonos oscuros.",
    "¿Cómo usar un blazer de forma casual?": "Con jeans, camiseta básica y tenis. Es un look relajado pero estiloso.",
    "¿Qué prendas usar si tengo cuerpo tipo triángulo invertido?": "Faldas con vuelo y tops sencillos o de colores neutros.",
    "¿Qué usar para un almuerzo familiar?": "Blusa fresca, jeans y zapatos bajos. Cómodo pero presentable.",
    "¿Qué calzado va con un vestido corto?": "Sandalias, botines o tenis según la ocasión.",
    "¿Cómo combino estampados sin fallar?": "Combina estampados del mismo color base o juega con proporciones: uno grande y otro pequeño.",
    "¿Qué ropa es ideal para días calurosos?": "Prendas de algodón, lino o tejidos ligeros. Evita ropa ajustada.",
    "¿Qué es el estilo minimalista en moda?": "Prendas básicas, colores neutros, sin exceso de accesorios ni estampados.",
    "¿Qué accesorios no pueden faltar?": "Cinturón, bolso básico, reloj y gafas de sol.",
    "¿Qué ropa usar con botas largas?": "Vestidos cortos, faldas o jeans ajustados dentro de las botas.",
    "¿Qué usar para un paseo al aire libre?": "Jeans, camiseta cómoda, tenis y una gorra o sombrero.",
    "¿Qué estilo de jeans está en tendencia?": "Jeans rectos, mom jeans y estilo wide leg están de moda.",
    "¿Qué diferencia hay entre ropa oversize y ropa holgada?": "La oversize es más estructurada y estilizada. La holgada es más suelta pero menos intencionada.",
}

@app.post("/chat")
def chat(request: ChatRequest):
    nombre = request.name.strip().capitalize()
    pregunta = limpiar_texto(request.question.strip())

    for key in faq:
        key_limpia = limpiar_texto(key)
        if pregunta in key_limpia or key_limpia in pregunta:
            return {
                "response": f"{faq[key]} {nombre}, recuerda que manejamos prendas desde $80.000. ¡Explora las secciones y encuentra tu estilo!"
            }
        # Coincidencia parcial flexible
        if pregunta in key_limpia or key_limpia in pregunta:
            return {"response": faq[key]}
    else:
        return {"response": f"Lo siento {nombre}, aún no tengo respuesta para esa pregunta. ¿Puedes intentarlo de otra forma?"}

@app.get("/")
def root():
    return {"message": "¡Hola! Soy el chatbot de asesoría de moda de MYP Tienda de Ropa"}