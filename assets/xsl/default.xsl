<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" xmlns:func="http://exslt.org/functions"
	xmlns:str="http://exslt.org/strings" xmlns:mtg="http://slothsoft.net/MTG/"
	extension-element-prefixes="php func str mtg">
	
	<xsl:variable name="rootPage" select="(//*[@name = 'sites']//*[@current])[1]" />
	
	<xsl:template match="/*">
		<html>
			<head>
				<title>
					<xsl:for-each select="$rootPage/ancestor-or-self::*[@title]">
						<xsl:sort select="position()" order="descending" />
						<xsl:if test="position() &gt; 1">
							<xsl:text> - </xsl:text>
						</xsl:if>
						<span data-dict=".">
							<xsl:value-of select="@title" />
						</span>
					</xsl:for-each>
				</title>
				<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
			</head>
			<body>
				<xsl:copy-of select="*[@name = 'navi']/*"/>
				<xsl:copy-of select="*[@name = 'content']/*"/>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>