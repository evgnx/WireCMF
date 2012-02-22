<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet [
<!ENTITY nbsp "&#160;">
<!ENTITY rarr "&#8594;">
]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="utf-8" indent="yes"/>
	<xsl:param name="label"/>
	
	<xsl:template match="root">
		<xsl:for-each select="item">
			<div>
				<xsl:attribute name="class">
					<xsl:if test="//root/@current_url = @href">curr</xsl:if>
					<xsl:if test="position() = 1"> first</xsl:if>
				</xsl:attribute>
			<a href="{@href}">
				<xsl:value-of select="@name" disable-output-escaping="yes"/>
			</a>
				<xsl:if test="position() != last()"><span> &rarr; </span></xsl:if>
				<xsl:if test="position() = last()"><span>&nbsp;</span></xsl:if> 
			</div>
		</xsl:for-each>
	</xsl:template>
		
	
</xsl:stylesheet>


