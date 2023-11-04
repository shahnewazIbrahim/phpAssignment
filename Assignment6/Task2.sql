SELECT p.id, p.name,oi.quantity, (oi.unit_price* oi.quantity) AS total_amount ,order_id
FROM products p
INNER JOIN order_items oi ON p.id = oi.product_id
ORDER BY oi.order_id ASC