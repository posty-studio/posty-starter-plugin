const ProductItem = ({ item }) => (
    <div className="teelaunch-products-overview__item">
        <div className="teelaunch-products-overview__image">
            {item.teelaunch.image && <img src={item.teelaunch.image} alt="" />}
        </div>
        {item.meta.teelaunch_product_price && (
            <span className="teelaunch-products-overview__price">${item.meta.teelaunch_product_price}</span>
        )}
        <span className="teelaunch-products-overview__category">{item.teelaunch.category}</span>
        <h3 className="teelaunch-products-overview__title">
            <a href={item.link}>{item.title.rendered}</a>
        </h3>
    </div>
);

export default ProductItem;
