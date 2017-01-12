SELECT Clients.NAME, count(Orders.ID) as count_order FROM Clients
	LEFT JOIN Orders ON Orders.Clients_id = Clients.ID
	LEFT JOIN Products ON Products.Order_id = Orders.ID
WHERE Orders.Ctime BETWEEN TO_DATE('2015-01', 'yyyy-mm') AND TO_DATE('2015-12', 'yyyy-mm')
	AND (
		Products.ID IN (151515,151617,151514) OR
		Clients.Email LIKE '%@mail.ru'
	)

GROUP BY Orders.ID 
ORDER BY sum(Products.Price)